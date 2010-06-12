<?php
/**
 * @file
 * @package rpglink
 * @version $Id$
**/

if(!defined('XOOPS_ROOT_PATH'))
{
	exit;
}

/**
 * Rpglink_LinkObject
**/
class Rpglink_LinkObject extends XoopsSimpleObject
{
	const PRIMARY = 'link_id';
	const DATANAME = 'link';

	public $mUpdate = array();
	 protected $_mUpdateLoadedFlag = false;
	public $mLrpg = array();
	 protected $_mLrpgLoadedFlag = false;

	/**
	 * __construct
	 * 
	 * @param	void
	 * 
	 * @return	void
	**/
	public function __construct()
	{
		$this->initVar('link_id', XOBJ_DTYPE_INT, '', false);
		$this->initVar('title', XOBJ_DTYPE_STRING, '', false, 255);
		$this->initVar('uid', XOBJ_DTYPE_INT, '', false);
		$this->initVar('url', XOBJ_DTYPE_STRING, '', false, 255);
		$this->initVar('banner', XOBJ_DTYPE_STRING, '', false, 255);
		$this->initVar('rss', XOBJ_DTYPE_STRING, '', false, 255);
		$this->initVar('pref_id', XOBJ_DTYPE_INT, '', false);
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
	 * loadUpdate
	 * 
	 * @param	void
	 * 
	 * @return	void
	 */
	public function loadUpdate()
	{
		if ($this->_mUpdateLoadedFlag == false) {
			$handler = Legacy_Utils::getModuleHandler('update', $this->getDirname());
			$this->mUpdate =& $handler->getObjects(new Criteria(self::PRIMARY, $this->get(self::PRIMARY)));
			$this->_mUpdateLoadedFlag = true;
		}
	}

	/**
	 * loadLrpg
	 * 
	 * @param	void
	 * 
	 * @return	void
	 */
	public function loadLrpg()
	{
		if ($this->_mLrpgLoadedFlag == false) {
			$handler = Legacy_Utils::getModuleHandler('lrpg', $this->getDirname());
			$this->mLrpg =& $handler->getObjects(new Criteria(self::PRIMARY, $this->get(self::PRIMARY)));
			$this->_mLrpgLoadedFlag = true;
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
		XCube_DelegateUtils::call('Legacy_ImageManager.GetImageObjects', new XCube_Ref($imageObjs), $this->getDirname(), 'link', $this->get('link_id'));
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
		case 'lrpg':
		case 'update':
			$handler = Legacy_Utils::getModuleHandler($dataname, $this->getDirname());
			$count = $handler->getCount(new Criteria('link_id', $this->get('link_id')));
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
		return Legacy_Utils::renderUri($this->getDirname(), null, $this->get(self::PRIMARY));
	}

	/**
	 * getCommonValue
	 * 
	 * @param	string	$key	data_id, title, uid, pubtime
	 * @param	string	$req	$player
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
			$value = $this->get('uid');
			break;
		case 'url' : 
			$value = $this->renderUri();
			break;
		case 'subinfo' : 
			$value = $this->get('pref_id');
			break;
		case 'description' : 
			$value = $this->get('desctiption');
			break;
		case 'pubtime' : 
			$value = $this->get('posttime');
			break;
		}
		return $value;
	}
}

/**
 * Rpglink_LinkHandler
**/
class Rpglink_LinkHandler extends XoopsObjectGenericHandler
{
	public /*** string ***/ $mTable = '{dirname}_link';

	public /*** string ***/ $mPrimary = 'link_id';

	public /*** string ***/ $mClass = 'Rpglink_LinkObject';

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
	 * @param	string	$childname	lrpg, update
	 * @param	int		$limit
	 * @param	int		$start
	 * 
	 * @return	void
	**/
	public function getChildObjects(/*** int ***/ $data_id, /*** string ***/ $childname, /*** int ***/ $limit=10, /*** int ***/ $start=0)
	{
		$cri = new CriteriaCompo();
		$cri->add(new Criteria($this->mPrimary, $data_id));
	
		switch($childname){
		case 'update':
			$dirname = $this->getDirname();
			$cri->setSort('posttime', 'DESC');
			break;
		case 'lrpg':
			$dirname = $this->getDirname();
			$cri->setSort('posttime', 'DESC');
			break;
		}
	
		$handler= Legacy_Utils::getModuleHandler($childname, $dirname);
		return $handler->getObjects($cri, $limit, $start);
	}
}

?>
