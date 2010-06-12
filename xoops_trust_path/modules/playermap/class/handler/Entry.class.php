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
 * Playermap_EntryObject
**/
class Playermap_EntryObject extends XoopsSimpleObject
{
	const PRIMARY = 'entry_id';
	const DATANAME = 'entry';

	public $mLog = null;
	protected $_mLogLoadedFlag = false;
	public $mPlayer = null;
	protected $_mPlayerLoadedFlag = false;
	public $mSche = array();

	/**
	 * __construct
	 * 
	 * @param	void
	 * 
	 * @return	void
	**/
	public function __construct()
	{
		$this->initVar('entry_id', XOBJ_DTYPE_INT, '', false);
		$this->initVar('log_id', XOBJ_DTYPE_INT, '', false);
		$this->initVar('uid', XOBJ_DTYPE_INT, '', false);
		$this->initVar('role', XOBJ_DTYPE_INT, '', false);
		$this->initVar('schedule', XOBJ_DTYPE_TEXT, '', false);
		$this->initVar('description', XOBJ_DTYPE_TEXT, '', false);
		$this->initVar('comment', XOBJ_DTYPE_TEXT, '', false);
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
	 * loadSchedule
	 * 
	 * @param	void
	 * 
	 * @return	int[]
	 */
	public function loadSchedule()
	{
		//current schedule setting
		$sche = array();
		$arr = explode(',',$this->get('schedule'));
		$starttime = array_pop($arr);
		$end = $starttime+27*86400;
		$d = $starttime;
	
		while($d<=$end){
			$sche[$d] = array_shift($arr);
			$d = $d + 86400;
		}
	
		$dateList = $this->_getDefaultSchedule();
		$this->loadLog();
		$calendar = $this->mLog->createHostCalendar();
		foreach($calendar as $cal){
			if(isset($sche[$cal])){
				$this->mSche[$cal] = $sche[$cal];
			}
			else{
				$date = date('w', $cal);
				$this->mSche[$cal] = $dateList[$date];
			}
		}
	}

	/**
	 * _getDefaultSchedule
	 * 
	 * @param	void
	 * 
	 * @return	int[]
	 */
	protected function _getDefaultSchedule()
	{
		$this->loadPlayer();
		$dateList = array(
			$this->mPlayer->get('sun'),
			$this->mPlayer->get('mon'),
			$this->mPlayer->get('tue'),
			$this->mPlayer->get('wed'),
			$this->mPlayer->get('thu'),
			$this->mPlayer->get('fri'),
			$this->mPlayer->get('sat')
		);
		return $dateList;
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
			$this->mLog =& $handler->get($this->get($handler->mPrimary));
			$this->_mLogLoadedFlag = true;
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
			$value = $this->get(self::PRIMARY);
			break;
		case 'title' : 
			if($req=='player'){
				$this->loadLog();
				$value = $this->mLog->get('title');
			}
			elseif($req=='log'){
				$this->loadPlayer();
				$value = $this->mPlayer->get('name');
			}
			break;
		case 'uid' : 
			$value = $this->get('uid');
			break;
		case 'url' : 
			if($req=='player'){
				$this->loadLog();
				$value = $this->mLog->renderUri();
			}
			elseif($req=='log'){
				$this->loadPlayer();
				$value = $this->mPlayer->renderUri();
			}
			break;
		case 'imageTag' : 
			if($req=='player'){
				$this->loadRpg();
				$value = Playermap_Utils::getImageTag($this->mLog, $tsize, 'source');
			}
			elseif($req=='log'){
				$this->loadPlayer();
				$value = Playermap_Utils::getImageTag($this->mPlayer, $tsize, 'source');
			}
			break;
		case 'subinfo' : 
			$value = $this->get('role');
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
 * Playermap_EntryHandler
**/
class Playermap_EntryHandler extends XoopsObjectGenericHandler
{
	public /*** string ***/ $mTable = '{dirname}_entry';

	public /*** string ***/ $mPrimary = 'entry_id';

	public /*** string ***/ $mClass = 'Playermap_EntryObject';

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

}

?>
