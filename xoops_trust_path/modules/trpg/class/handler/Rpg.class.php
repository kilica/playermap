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
 * Trpg_RpgObject
**/
class Trpg_RpgObject extends XoopsSimpleObject
{
	const PRIMARY = 'rpg_id';
	const DATANAME = 'rpg';

	public $mBook = array();
	 protected $_mBookLoadedFlag = false;

	/**
	 * __construct
	 * 
	 * @param	void
	 * 
	 * @return	void
	**/
	public function __construct()
	{
		$this->initVar('rpg_id', XOBJ_DTYPE_INT, 0, false);
		$this->initVar('title', XOBJ_DTYPE_STRING, '', false, 255);
		$this->initVar('kana', XOBJ_DTYPE_STRING, '', false, 128);
		$this->initVar('abbr', XOBJ_DTYPE_STRING, '', false, 60);
		$this->initVar('pub_id', XOBJ_DTYPE_INT, 0, false);
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
	 * getShowAbbr
	 * 
	 * @param	void
	 * 
	 * @return	string
	 */
	public function getShowAbbr()
	{
		$list = explode(',',$this->getShow('abbr'));
		return (count($list)>0) ? array_shift($list) : null;
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
	
		$handler = Legacy_Utils::getModuleHandler('favrpg', PLAYERMAP_DIRNAME);
		$cri = new CriteriaCompo();
		$cri->add(new Criteria('rpg_id', $this->get('rpg_id')));
		$cri->add(new Criteria('uid', $uid));
		$objs = $handler->getObjects($cri);
		return (count($objs)>0) ? array_shift($objs)->getShow('rating') : 0;
	}

	/**
	 * getImage
	 * 
	 * @param	void
	 * 
	 * @return	Legacy_AbstractImageObject
	 */
	public function getImage()
	{
		$imageObjs = array();
		XCube_DelegateUtils::call('Legacy_ImageManager.GetImageObjects', new XCube_Ref($imageObjs), $this->getDirname(), $this->getDataname(), $this->get($this->getPrimary()));
		if(count($imageObjs)>0){
			return array_shift($imageObjs);
		}
	}

	/**
	 * loadBook
	 * 
	 * @param	void
	 * 
	 * @return	void
	 */
	public function loadBook()
	{
		if ($this->_mBookLoadedFlag == false) {
			$handler = Legacy_Utils::getModuleHandler('book', $this->getDirname());
			$this->mBook =& $handler->getObjects(new Criteria(self::PRIMARY, $this->get(self::PRIMARY)));
			$this->_mBookLoadedFlag = true;
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
		case 'favrpg':
		case 'log':
			$handler = Legacy_Utils::getModuleHandler($dataname, PLAYERMAP_DIRNAME);
			$count = $handler->getCount(new Criteria(self::PRIMARY, $this->get(self::PRIMARY)));
			break;
		case 'link':
			$handler = Legacy_Utils::getModuleHandler($dataname, RPGLINK_DIRNAME);
			$count = $handler->getCount(new Criteria(self::PRIMARY, $this->get('rpg_id')));
			break;
		case 'book':
			$handler = Legacy_Utils::getModuleHandler($dataname, $this->getDirname());
			$count = $handler->getCount(new Criteria(self::PRIMARY, $this->get(self::PRIMARY)));
			break;
		}
	
		return intval($count);
	}

	/**
	 * getPrimaryBook
	 * 
	 * @param	void
	 * 
	 * @return	Trpg_BookObject
	 */
	public function getPrimaryBook()
	{
		$cri = new CriteriaCompo();
		$cri->add(new Criteria(self::PRIMARY, $this->get(self::PRIMARY)));
		$cri->add(new Criteria('btype', Pmenum_Btype::PRIMARY));
		$cri->setSort('pubyear', 'DESC');
		$handler = Legacy_Utils::getModuleHandler('book', $this->getDirname());
		$objs = $handler->getObjects($cri);
		if(count($objs)>0){
			return array_shift($objs);
		}
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
		return Legacy_Utils::renderUri($this->getDirname(), null, $this->get(self::PRIMARY));
	}
}

/**
 * Trpg_RpgHandler
**/
class Trpg_RpgHandler extends XoopsObjectGenericHandler
{
	public /*** string ***/ $mTable = '{dirname}_rpg';

	public /*** string ***/ $mPrimary = 'rpg_id';

	public /*** string ***/ $mClass = 'Trpg_RpgObject';

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
	 * @param	string	$childname	book, favrpg, log
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
		case 'book':
			$dirname = $this->getDirname();
			$cri->setSort('pubyear');
			break;
		case 'favrpg':
			$dirname = PLAYERMAP_DIRNAME;
			$cri->setSort('posttime', 'DESC');
			break;
		case 'log':
			$dirname = PLAYERMAP_DIRNAME;
			$cri->setSort('sessiontime', 'DESC');
			break;
		case 'lrpg':
			$dirname = RPGLINK_DIRNAME;
			$cri->setSort('posttime', 'DESC');
			break;
		}
	
		$handler= Legacy_Utils::getModuleHandler($childname, $dirname);
		return $handler->getObjects($cri, $limit, $start);
	}
}

?>
