<?php
/**
 * @file
 * @package trpg
 * @version $Id$
**/

if(!defined('XOOPS_ROOT_PATH'))
{
	exit;
}

/**
 * Trpg_BookObject
**/
class Trpg_BookObject extends XoopsSimpleObject
{
	const PRIMARY = 'book_id';
	const DATANAME = 'book';

	public $mRpg = null;
	  protected $_mRpgLoadedFlag = false;

	/**
	 * __construct
	 * 
	 * @param	void
	 * 
	 * @return	void
	**/
	public function __construct()
	{
		$this->initVar('book_id', XOBJ_DTYPE_INT, '', false);
		$this->initVar('title', XOBJ_DTYPE_STRING, '', false, 255);
		$this->initVar('rpg_id', XOBJ_DTYPE_INT, 0, false);
		$this->initVar('version', XOBJ_DTYPE_STRING, '', false, 60);
		$this->initVar('btype', XOBJ_DTYPE_INT, Pmenum_Btype::SUPPLEMENT, false);
		$this->initVar('pub_id', XOBJ_DTYPE_INT, 0, false);
		$this->initVar('isbn', XOBJ_DTYPE_STRING, '', false, 15);
		$this->initVar('isbn13', XOBJ_DTYPE_STRING, '', false, 15);
		$this->initVar('pubyear', XOBJ_DTYPE_INT, 0, false);
		$this->initVar('price', XOBJ_DTYPE_FLOAT, 0.0, false);
		$this->initVar('currency', XOBJ_DTYPE_INT, Pmenum_Currency::JPY, false);
		$this->initVar('url', XOBJ_DTYPE_STRING, '', false, 255);
		$this->initVar('description', XOBJ_DTYPE_TEXT, '', false);
		$this->initVar('posttime', XOBJ_DTYPE_INT, time(), false);
	}

	/**
	 * getPrimary
	 * 
	 * @param	void
	 * 
	 * @return	string
	**/
	public function getPrimary()
	{
		return self::PRIMARY;
	}

	/**
	 * getDataname
	 * 
	 * @param	void
	 * 
	 * @return	string
	**/
	public function getDataname()
	{
		return self::DATANAME;
	}

	/**
	 * getMyRating
	 * 
	 * @param	void
	 * 
	 * @return	int
	 */
	public function getMyRating()
	{
		$uid = Legacy_Utils::getUid();
		if($uid==0) return 0;
	
		$handler = Legacy_Utils::getModuleHandler('review', PLAYERMAP_DIRNAME);
		$cri = new CriteriaCompo();
		$cri->add(new Criteria('book_id', $this->get('book_id')));
		$cri->add(new Criteria('uid', $uid));
		$objs = $handler->getObjects($cri);
		return (count($objs)>0) ? array_shift($objs)->getShow('rating') : 0;
	}

	/**
	 * loadRpg
	 * 
	 * @param	void
	 * 
	 * @return	void
	 */
	public function loadRpg()
	{
		if ($this->_mRpgLoadedFlag == false) {
			$handler = Legacy_Utils::getModuleHandler('rpg', $this->getDirname());
			$this->mRpg =& $handler->get($this->get('rpg_id'));
			$this->_mRpgLoadedFlag = true;
		}
	}

	/**
	 * getImage
	 * 
	 * @param	void
	 * 
	 * @return	void
	 */
	public function getImage()
	{
		$imageObjs = array();
		XCube_DelegateUtils::call('Legacy_ImageManager.GetImageObjects', new XCube_Ref($imageObjs), $this->getDirname(), 'book', $this->get('book_id'));
		if(count($imageObjs)>0){
			return array_shift($imageObjs);
		}
	}

	/**
	 * countChild
	 * 
	 * @param	string	$dataname
	 * 
	 * @return	int
	 */
	public function countChild($dataname)
	{
		switch($dataname){
		case 'review':
			$handler = Legacy_Utils::getModuleHandler($dataname, PLAYERMAP_DIRNAME);
			$count = $handler->getCount(new Criteria(self::PRIMARY, $this->get(self::PRIMARY)));
			break;
		}
	
		return intval($count);
	}

	/**
	 * renderUri
	 * 
	 * @param	void
	 * 
	 * @return	string
	 */
	public function renderUri()
	{
		return Legacy_Utils::renderUri($this->getDirname(), 'book', $this->get(self::PRIMARY));
	}

	/**
	 * getCommonValue
	 * 
	 * @param	string	$key	data_id, title, uid, pubtime
	 * @param	string	req		rpg
	 * 
	 * @return	void
	 */
	public function getCommonValue(/*** string ***/ $key, /*** string ***/ $req=null)
	{
		$value = null;
		switch($key){
		case 'data_id': 
			$value = $this->get(self::PRIMARY);
			break;
		case 'title' : 
			$value = $this->get('title');
			break;
		case 'uid' : 
			$value = 0;
			break;
		case 'url' : 
			$value = $this->renderUri();
			break;
		case 'description' : 
			$value = $this->get('description');
			break;
		case 'subinfo' : 
			$value = $this->get('price');
			break;
		case 'pubtime' : 
			$value = $this->get('posttime');
			break;
		}
		return $value;
	}
}

/**
 * Trpg_BookHandler
**/
class Trpg_BookHandler extends XoopsObjectGenericHandler
{
	public /*** string ***/ $mTable = '{dirname}_book';

	public /*** string ***/ $mPrimary = 'book_id';

	public /*** string ***/ $mClass = 'Trpg_BookObject';

	/**
	 * __construct
	 * 
	 * @param	XoopsDatabase  &$db
	 * @param	string	$dirname
	 * 
	 * @return	void
	**/
	public function __construct(/*** XoopsDatabase ***/ &$db,/*** string ***/ $dirname)
	{
		$this->mTable = strtr($this->mTable,array('{dirname}' => $dirname));
		parent::XoopsObjectGenericHandler($db);
	}

	/**
	 * getChildObjects
	 * 
	 * @param	int		$data_id
	 * @param	string	$childname	review
	 * @param	int		$limit
	 * @param	int		$start
	 * 
	 * @return	Criteria
	**/
	public function getChildObjects(/*** int ***/ $data_id, /*** string ***/ $childname, /*** int ***/ $limit=10, /*** int ***/ $start=0)
	{
		$cri = new CriteriaCompo();
		$cri->add(new Criteria($this->mPrimary, $data_id));
	
		switch($childname){
		case 'review':
			$dirname = PLAYERMAP_DIRNAME;
			$cri->setSort('posttime', 'DESC');
			break;
		}
	
		$handler= Legacy_Utils::getModuleHandler($childname, $dirname);
		return $handler->getObjects($cri, $limit, $start);
	}
}

?>
