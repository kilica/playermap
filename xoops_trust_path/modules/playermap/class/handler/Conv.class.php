<?php
/**
 * @file
 * @package playermap
 * @version $Id$
**/

if(!defined('XOOPS_ROOT_PATH'))
{
	exit;
}

/**
 * Playermap_ConvObject
**/
class Playermap_ConvObject extends XoopsSimpleObject
{
	const PRIMARY = 'conv_id';
	const DATANAME = 'conv';

	public $mPlayer = null;
	protected $_mPlayerLoadedFlag = false;
	public $mGroup = null;
	protected $_mGroupLoadedFlag = false;
	public $mLog = array();
	protected $_mLogLoadedFlag = false;

	/**
	 * __construct
	 * 
	 * @param	void
	 * 
	 * @return	void
	**/
	public function __construct()
	{
		$this->initVar('conv_id', XOBJ_DTYPE_INT, '', false);
		$this->initVar('title', XOBJ_DTYPE_STRING, '', false, 255);
		$this->initVar('uid', XOBJ_DTYPE_INT, 0, false);
		$this->initVar('group_id', XOBJ_DTYPE_INT, 0, false);
		$this->initVar('pref_id', XOBJ_DTYPE_INT, 0, false);
		$this->initVar('site', XOBJ_DTYPE_STRING, '', false, 255);
		$this->initVar('address', XOBJ_DTYPE_TEXT, '', false);
		$this->initVar('cv_lat', XOBJ_DTYPE_FLOAT, 0.0, false);
		$this->initVar('cv_lng', XOBJ_DTYPE_FLOAT, 0.0, false);
		$this->initVar('starttime', XOBJ_DTYPE_INT, time(), false);
		$this->initVar('endtime', XOBJ_DTYPE_INT, time(), false);
		$this->initVar('booking', XOBJ_DTYPE_INT, Pmenum_Booking::NEEDNO, false);
		$this->initVar('fee', XOBJ_DTYPE_TEXT, '', false);
		$this->initVar('capacity', XOBJ_DTYPE_INT, 0, false);
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
	 * loadPlayer
	 * 
	 * @param	void
	 * 
	 * @return	void
	 */
	public function loadPlayer()
	{
		if ($this->_mPlayerLoadedFlag == false) {
			$handler = Legacy_Utils::getModuleHandler('player', $this->getDirname());
			$this->mPlayer =& $handler->get($handler->mPrimary);
			$this->_mPlayerLoadedFlag = true;
		}
	}

	/**
	 * loadGroup
	 * 
	 * @param	void
	 * 
	 * @return	void
	 */
	public function loadGroup()
	{
		if ($this->_mGroupLoadedFlag == false) {
			$handler = Legacy_Utils::getModuleHandler('group', $this->getDirname());
			$this->mGroup =& $handler->get($this->get('group_id'));
			$this->_mGroupLoadedFlag = true;
		}
	}

	/**
	 * loadLog
	 * 
	 * @param	void
	 * 
	 * @return	void
	 */
	public function loadLog()
	{
		if ($this->_mLogLoadedFlag == false) {
			$handler = Legacy_Utils::getModuleHandler('log', $this->getDirname());
			$this->mLog =& $handler->getObjects(new Criteria(self::PRIMARY, $this->get('conf_id')));
			$this->_mLogLoadedFlag = true;
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
		case 'log':
			$handler = Legacy_Utils::getModuleHandler($dataname, $this->getDirname());
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
		return Legacy_Utils::renderUri($this->getDirname(), null, $this->get(self::PRIMARY));
	}

	/**
	 * getCommonValue
	 * 
	 * @param	string	$key	group
	 * @param	string	$req
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
			$value = $this->get('starttime');
			break;
		}
		return $value;
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
		XCube_DelegateUtils::call('Legacy_ImageManager.GetImageObjects', new XCube_Ref($imageObjs), $this->getDirname(), $this->getDataname(), $this->getPrimary());
		if(count($imageObjs)>0){
			return array_shift($imageObjs);
		}
	}
}

/**
 * Playermap_ConvHandler
**/
class Playermap_ConvHandler extends XoopsObjectGenericHandler
{
	public /*** string ***/ $mTable = '{dirname}_conv';

	public /*** string ***/ $mPrimary = 'conv_id';

	public /*** string ***/ $mClass = 'Playermap_ConvObject';

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
	 * @param	string	$childname	log
	 * @param	int		$limit
	 * @param	int		$start
	 * 
	 * @return	void
	**/
	public function getChildObjects(/*** int ***/ $data_id, /*** string ***/ $childname, /*** int ***/ $limit=10, /*** int ***/ $start=0)
	{
		$dirname = $this->getDirname();
		$cri = new CriteriaCompo();
		$cri->add(new Criteria($this->mPrimary, $data_id));
	
		switch($childname){
		case 'log':
			$cri->setSort('sessiontime', 'DESC');
			break;
		}
	
		$handler= Legacy_Utils::getModuleHandler($childname, $dirname);
		return $handler->getObjects($cri, $limit, $start);
	}
}

?>
