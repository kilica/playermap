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
 * Playermap_PlayerObject
**/
class Playermap_PlayerObject extends XoopsSimpleObject
{
	const PRIMARY = 'uid';
	const DATANAME = 'player';

	public $mConne = array();
	 protected $_mConneLoadedFlag = false;
	public $mFavrpg = array();
	 protected $_mFavrpgLoadedFlag = false;
	public $mEntry = array();
	 protected $_mEntryLoadedFlag = false;

	/**
	 * __construct
	 * 
	 * @param	void
	 * 
	 * @return	void
	**/
	public function __construct()
	{
		$this->initVar('uid', XOBJ_DTYPE_INT, '', false);
		$this->initVar('name', XOBJ_DTYPE_STRING, '', false, 255);
		$this->initVar('gender', XOBJ_DTYPE_INT, Pmenum_Gender::UNKNOWN, false);
		$this->initVar('birthyear', XOBJ_DTYPE_INT, 0, false);
		$this->initVar('startyear', XOBJ_DTYPE_INT, 0, false);
		$this->initVar('pref_id', XOBJ_DTYPE_INT, '', false);
		$this->initVar('address', XOBJ_DTYPE_TEXT, '', false);
		$this->initVar('pl_lat', XOBJ_DTYPE_FLOAT, 0.0, false);
		$this->initVar('pl_lng', XOBJ_DTYPE_FLOAT, 0.0, false);
		$this->initVar('role', XOBJ_DTYPE_INT, Pmenum_Role::PLAYER, false);
		$this->initVar('sun', XOBJ_DTYPE_INT, 0, false);
		$this->initVar('mon', XOBJ_DTYPE_INT, 0, false);
		$this->initVar('tue', XOBJ_DTYPE_INT, 0, false);
		$this->initVar('wed', XOBJ_DTYPE_INT, 0, false);
		$this->initVar('thu', XOBJ_DTYPE_INT, 0, false);
		$this->initVar('fri', XOBJ_DTYPE_INT, 0, false);
		$this->initVar('sat', XOBJ_DTYPE_INT, 0, false);
		$this->initVar('hol', XOBJ_DTYPE_INT, 0, false);
		$this->initVar('pbn', XOBJ_DTYPE_INT, 0, false);
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

	public function getShowDate(/*** string ***/ $key)
	{
		return Pmenum_Off::show($this->get($key));
	}

	/**
	 * loadConne
	 * 
	 * @param	void
	 * 
	 * @return	void
	 */
	public function loadConne()
	{
		if ($this->_mConneLoadedFlag == false) {
			$handler = Legacy_Utils::getModuleHandler('conne', $this->getDirname());
			$this->mConne =& $handler->getObjects(new Criteria(self::PRIMARY, $this->get(self::PRIMARY)));
			$this->_mConneLoadedFlag = true;
		}
	}

	/**
	 * checkedAsConne
	 * 
	 * @param	void
	 * 
	 * @return	Enum	Pmenum_Cstat
	 */
	public function checkedAsConne()
	{
		$uid = Legacy_Utils::getUid();
		$handler = Legacy_Utils::getModuleHandler('conne', $this->getDirname());
		$uidList = $handler->getFriendIdList($uid, Pmenum_Cstat::ONEWAY);
		return (in_array($this->get('uid'), $uidList)) ? true : false;
	}

	/**
	 * loadFavrpg
	 * 
	 * @param	void
	 * 
	 * @return	void
	 */
	public function loadFavrpg()
	{
		if ($this->_mFavrpgLoadedFlag == false) {
			$handler = Legacy_Utils::getModuleHandler('favrpg', $this->getDirname());
			$this->mFavrpg =& $handler->getObjects(new Criteria(self::PRIMARY, $this->get(self::PRIMARY)));
			$this->_mFavrpgLoadedFlag = true;
		}
	}

	/**
	 * loadEntry
	 * 
	 * @param	void
	 * 
	 * @return	void
	 */
	public function loadEntry()
	{
		if ($this->_mEntryLoadedFlag == false) {
			$handler = Legacy_Utils::getModuleHandler('entry', $this->getDirname());
			$this->mLog =& $handler->getObjects(new Criteria(self::PRIMARY, $this->get(self::PRIMARY)));
			$this->_mEntryLoadedFlag = true;
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
		case 'entry':
		case 'favrpg':
		case 'review':
			$handler = Legacy_Utils::getModuleHandler($dataname, $this->getDirname());
			$count = $handler->getCount(new Criteria(self::PRIMARY, $this->get(self::PRIMARY)));
			break;
		case 'link':
			$handler = Legacy_Utils::getModuleHandler($dataname, RPGLINK_DIRNAME);
			$count = $handler->getCount(new Criteria(self::PRIMARY, $this->get(self::PRIMARY)));
			break;
		case 'member':
			$handler = Legacy_Utils::getModuleHandler($dataname, $this->getDirname());
			$cri = new CriteriaCompo();
			$cri->add(new Criteria(self::PRIMARY, $this->get(self::PRIMARY)));
			$cri->add(new Criteria('rank', Lenum_GroupRank::ASSOCIATE, '>='));
			$cri->add(new Criteria('status', Lenum_ProgressStatus::FINISHED));
			$count = $handler->getCount($cri);
			break;
		case 'conne':
			$handler = Legacy_Utils::getModuleHandler($dataname, $this->getDirname());
			$cri = new CriteriaCompo();
			$cri->add(new Criteria(self::PRIMARY, $this->get(self::PRIMARY)));
			$cri->add(new Criteria('stat', Pmenum_Cstat::TWOWAY));
			$count = $handler->getCount($cri);
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
 * Playermap_PlayerHandler
**/
class Playermap_PlayerHandler extends XoopsObjectGenericHandler
{
	public /*** string ***/ $mTable = '{dirname}_player';

	public /*** string ***/ $mPrimary = 'uid';

	public /*** string ***/ $mClass = 'Playermap_PlayerObject';

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
	 * @param	string	$childname	member, entry, link, favrpg, conne
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
		case 'link':
			$dirname = RPGLINK_DIRNAME;
			$cri->setSort('posttime', 'ASC');
			break;
		case 'member':
			$cri->add(new Criteria('rank', Pmenum_Member::ASSOCIATE, '>='));
			$cri->setSort('posttime', 'ASC');
			break;
		case 'entry':
			$cri->setSort('posttime', 'DESC');
			break;
		case 'favrpg':
			$cri->setSort('posttime', 'DESC');
			break;
		case 'review':
			$cri->setSort('posttime', 'DESC');
			break;
		case 'conne':
			$cri->setSort('accepttime', 'DESC');
			$cri->add(new Criteria('stat', Pmenum_Cstat::TWOWAY));
			break;
		}
	
		$handler = Legacy_Utils::getModuleHandler($childname, $dirname);
		return $handler->getObjects($cri, $limit, $start);
	}
}

?>
