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
 * Playermap_LogObject
**/
class Playermap_LogObject extends XoopsSimpleObject
{
	const PRIMARY = 'log_id';
	const DATANAME = 'log';

	public $mEntry = array();
	protected $_mEntryLoadedFlag = false;
	public $mPlayer = null;
	protected $_mPlayerLoadedFlag = false;
	public $mRpg = null;
	protected $_mRpgLoadedFlag = false;
	public $mGroup = null;
	protected $_mGroupLoadedFlag = false;

	/**
	 * __construct
	 * 
	 * @param	void
	 * 
	 * @return	void
	**/
	public function __construct()
	{
		$this->initVar('log_id', XOBJ_DTYPE_INT, '', false);
		$this->initVar('title', XOBJ_DTYPE_STRING, '', false, 255);
		$this->initVar('uid', XOBJ_DTYPE_INT, '', false);
		$this->initVar('rpg_id', XOBJ_DTYPE_INT, '', false);
		$this->initVar('group_id', XOBJ_DTYPE_INT, '', false);
		$this->initVar('conv_id', XOBJ_DTYPE_INT, '', false);
		$this->initVar('sessiontime', XOBJ_DTYPE_INT, time(), false);
		$this->initVar('scheduletime', XOBJ_DTYPE_INT, time(), false);
		$this->initVar('recruit', XOBJ_DTYPE_INT, '', false);
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
	 * createCalendar
	 * 
	 * @param	void
	 * 
	 * @return	int[]
	 */
	public function createCalendar()
	{
		$starttime = $this->get('scheduletime');
		$end = $starttime+27*86400;
		$d = $starttime;
		$startdate = date('w', $starttime);
		while($d<=$end){
			$cal[] = $d;
			$d = $d + 86400;
		}
	
		return $cal;
	}

	/**
	 * createHostCalendar
	 * 
	 * @param	void
	 * 
	 * @return	int[]
	 */
	public function createHostCalendar()
	{
		$handler = Legacy_Utils::getModuleHandler('entry', $this->getDirname());
		$cri = new CriteriaCompo();
		$cri->add(new Criteria('uid', $this->get('uid')));
		$cri->add(new Criteria('log_id', $this->get('log_id')));
		$entries = $handler->getObjects($cri);
		if(count($entries)>0){
			$entry = array_shift($entries);
			//$entry->loadSchedule();
			$calendar = $entry->mSche;
		
			$ret = array();
			foreach($calendar as $cal){
				if($cal>86400){
					$ret[] = $cal;
				}
			}
			return $ret;
		}
		else{
			return $this->createCalendar();
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
			$this->mEntry =& $handler->getObjects(new Criteria(self::PRIMARY, $this->get(self::PRIMARY)));
			$this->_mEntryLoadedFlag = true;
		}
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
			$this->mPlayer =& $handler->get($this->get($handler->mPrimary));
			$this->_mPlayerLoadedFlag = true;
		}
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
			$handler = Legacy_Utils::getModuleHandler('rpg', TRPG_DIRNAME);
			$this->mRpg =& $handler->get($this->get($handler->mPrimary));
			$this->_mRpgLoadedFlag = true;
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
			$this->mGroup =& $handler->get($this->get($handler->mPrimary));
			$this->_mGroupLoadedFlag = true;
		}
	}

	/**
	 * getShowTime
	 * 
	 * @param	void
	 * 
	 * @return	void
	 */
	public function getShowTime()
	{
		if($this->get('sessiontime')>86400){
			return $this->getShow('sessiontime');
		}
		else{
			return $this->getShow('scheduletime');
		}
	}

	/**
	 * getPlace
	 * 
	 * @param	string $key		id/title/uri
	 * 
	 * @return	mixed
	 *	  $place['id']		int
	 *	  $place['title']	string
	 *	  $place['uri']		string
	 */
	public function getPlace(/*** string ***/ $key=null)
	{
		if($this->get('group_id')>0){
			$this->loadGroup();
			$place = array('id'=>$this->get('group_id'), 'title'=>$this->mGroup->getShow('title'), 'uri'=>Legacy_Utils::renderUri($this->getDirname,'group',$this->get('group_id')));
		}
		elseif($this->get('conv_id')>0){
			$place = array('id'=>$this->get('conv_id'), 'title'=>$this->mConv->getShow('title'), 'uri'=>Legacy_Utils::renderUri($this->getDirname,'conv',$this->get('group_id')));
		}
		else{
			$place = array('id'=>$this->get('uid'), 'title'=>Legacy_Utils::getUserName($this->get('uid')), 'uri'=>Legacy_Utils::renderUri($this->getDirname,'player',$this->get('uid')));
		}
		return ($key===null) ? $place : $place[$key];
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
	 * @param	string	$key	data_id, title, uid, pubtime
	 * @param	string	$req	player, rpg
	 * @param	int		$tsize	thumbnail size
	 * 
	 * @return	void
	 */
	public function getCommonValue(/*** string ***/ $key, /*** string ***/ $req=null, /*** int ***/ $tsize=2)
	{
		$value = null;
		switch($key){
		case 'data_id': 
			$value = $this->get('group_id');
			break;
		case 'title' : 
			if($req=='player'){
				$this->loadRpg();
				$value = $this->mRpg->get('title');
			}
			elseif($req=='rpg'){
				$this->loadPlayer();
				$value = $this->mPlayer->get('name');
			}
			break;
		case 'uid' : 
			$value = $this->get('uid');
			break;
		case 'url' : 
			if($req=='player'){
				$this->loadRpg();
				$value = $this->mRpg->renderUri();
			}
			elseif($req=='rpg'){
				$this->loadPlayer();
				$value = $this->mPlayer->renderUri();
			}
			break;
		case 'imageTag' : 
			if($req=='player'){
				$this->loadRpg();
				$value = Playermap_Utils::getImageTag($this->mRpg, $tsize, 'source');
			}
			elseif($req=='rpg'){
				$this->loadPlayer();
				$value = Playermap_Utils::getImageTag($this->mPlayer, $tsize, 'source');
			}
			break;
		case 'subinfo' : 
			$place = $this->getPlace();
			$value = $place['title'];
			break;
		case 'description' : 
			$value = $this->get('description');
			break;
		case 'pubtime' : 
			if($this->get('sessiontime')>0){
				$value = $this->get('sessiontime');
			}
			else{
				$value = $this->get('scheduletime');
			}
			break;
		}
		return $value;
	}
}

/**
 * Playermap_LogHandler
**/
class Playermap_LogHandler extends XoopsObjectGenericHandler
{
	public /*** string ***/ $mTable = '{dirname}_log';

	public /*** string ***/ $mPrimary = 'log_id';

	public /*** string ***/ $mClass = 'Playermap_LogObject';

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
	 * @param	string	$childname	member, log, conv
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
		case 'entry':
			$cri->setSort('posttime', 'DESC');
			break;
		}
	
		$handler = Legacy_Utils::getModuleHandler($childname, $dirname);
		return $handler->getObjects($cri, $limit, $start);
	}
}

?>
