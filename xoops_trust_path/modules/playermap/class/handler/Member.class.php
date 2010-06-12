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
 * Playermap_MemberObject
**/
class Playermap_MemberObject extends XoopsSimpleObject
{
	const PRIMARY = 'member_id';
	const DATANAME = 'member';

	public $mGroup = null;
	protected $_mGroupLoadedFlag = false;
	public $mPlayer = null;
	protected $_mPlayerLoadedFlag = false;

	/**
	 * __construct
	 * 
	 * @param	void
	 * 
	 * @return	void
	**/
	public function __construct()
	{
		$this->initVar('member_id', XOBJ_DTYPE_INT, '', false);
		$this->initVar('group_id', XOBJ_DTYPE_INT, 0, false);
		$this->initVar('uid', XOBJ_DTYPE_INT, 0, false);
		$this->initVar('status', XOBJ_DTYPE_INT, Lenum_ProgressStatus::PROGRESS, false);
		$this->initVar('since', XOBJ_DTYPE_INT, 0, false);
		$this->initVar('rank', XOBJ_DTYPE_INT, Pmenum_Member::GUEST, false);
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
		switch($key){
		case 'data_id': 
			$value = $this->get(self::PRIMARY);
			break;
		case 'title' : 
			if($req=='player'){
				$this->loadGroup();
				$value = $this->mGroup->get('title');
			}
			elseif($req=='group'){
				$this->loadPlayer();
				$value = $this->mPlayer->get('name');
			}
			break;
		case 'uid' : 
			$value = $this->get('uid');
			break;
		case 'url' : 
			if($req=='player'){
				$this->loadGroup();
				$value = $this->mGroup->renderUri();
			}
			elseif($req=='group'){
				$this->loadPlayer();
				$value = $this->mPlayer->renderUri();
			}
			break;
		case 'imageTag' : 
			if($req=='player'){
				$this->loadGroup();
				$value = Playermap_Utils::getImageTag($this->mGroup, $tsize, 'source');
			}
			elseif($req=='group'){
				$this->loadPlayer();
				$value = Playermap_Utils::getImageTag($this->mPlayer, $tsize, 'source');
			}
			break;
		case 'subinfo' : 
			$value = $this->get('rank');
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
 * Playermap_MemberHandler
**/
class Playermap_MemberHandler extends XoopsObjectGenericHandler
{
	public /*** string ***/ $mTable = '{dirname}_member';

	public /*** string ***/ $mPrimary = 'member_id';

	public /*** string ***/ $mClass = 'Playermap_MemberObject';

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
	 * insert
	 * 
	 * @param	XoopsSimpleObject	&$obj
	 * @param	bool	$force
	 * 
	 * @return	bool
	**/
	public function insert(/*** XoopsSimpleObject ***/ &$obj, $force=false)
	{
		$result = parent::insert($obj, $force);
		$handler = Legacy_Utils::getModuleHandler('permission', $this->getDirname());
		$obj->loadGroup();
		$dataList = $obj->mGroup->getClientDataList();
		foreach($dataList as $data){
			$permission = $handler->insertPermission($obj->get('group_id'), $obj->get('uid'), $data['dirname'], $data['dataname']);
		}
		return $result;
	}

	/**
	 * delete
	 * 
	 * @param	XoopsSimpleObject	&$obj
	 * @param	bool	$force
	 * 
	 * @return	bool
	**/
	public function delete(/*** XoopsSimpleObject ***/ &$obj, $force=false)
	{
		$result = parent::delete($obj, $force);
		$handler = Legacy_Utils::getModuleHandler('permission', $this->getDirname());
		$cri = new CriteriaCompo();
		$cri->set('uid', $obj->get('uid'));
		$cri->set('group_id', $obj->get('group_id'));
		$handler->deleteAll($cri);
	
		return $result;
	}

	/**
	 * getMyGroupIdList
	 * 
	 * @param	Enum	$rank	Lenum_GroupRank
	 * 
	 * @return	int[]
	**/
	public function getMyGroupIdList(/*** Enum ***/ $rank=Lenum_GroupRank::REGULAR, /*** Enum ***/ $authType=Pmenum_Permission::READ)
	{
		$uid = Legacy_Utils::getUid();
		$cri = new CriteriaCompo();
		$cri->add(new Criteria('uid', $uid));
		$cri->add(new Criteria('rank', $rank, '>='));
		$cri->add(new Criteria('status', Lenum_ProgressStatus::FINISHED));
		$cri->setSort('posttime', 'DESC');
		$objs = $this->getObjects($cri);
		foreach(array_keys($objs) as $key){
			
			$ret[] = $objs[$key]->get('group_id');
		}
		return $ret;
	}

	/**
	 * getMemberIdList
	 * 
	 * @param	int		$groupId
	 * @param	Enum	$rank	Lenum_GroupRank
	 * 
	 * @return	int[]
	**/
	public function getMemberIdList(/*** int ***/ $groupId, /*** Enum ***/ $rank=Lenum_GroupRank::REGULAR)
	{
		$cri = new CriteriaCompo();
		$cri->add(new Criteria('group_id', $groupId));
		$cir->add(new Criteria('rank', $rank, '>='));
		$cri->add(new Criteria('status', Lenum_ProgressStatus::FINISHED));
		$cri->setSort('posttime', 'DESC');
		$objs = $this->geObjects($cri);
		foreach(array_keys($objs) as $key){
			$ret['uid'][] = $objs[$key]->get('uid');
			$ret['rank'][] = $objs[$key]->get('rank');
		}
		return $ret;
	}

	/**
	 * isMember
	 * 
	 * @param	int		$groupId
	 * @param	int		$uid
	 * @param	Enum	$rank	Lenum_GroupRank
	 * 
	 * @return	int[]
	**/
	public function isMember(/*** int ***/ $groupId, /*** int ***/ $uid, /*** Enum ***/ $rank=Lenum_GroupRank::REGULAR)
	{
		$cri = new CriteriaCompo();
		$cri->add(new Criteria('group_id', $groupId));
		$cri->add(new Criteria('uid', $uid));
		$cir->add(new Criteria('rank', $rank, '>='));
		$cri->add(new Criteria('status', Lenum_ProgressStatus::FINISHED));
		$cri->setSort('posttime', 'DESC');
		$ids = $this->getIdList($cri);
		return count($ids>0) ? true :false;
	}
}

?>
