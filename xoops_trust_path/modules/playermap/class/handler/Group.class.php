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
 * Playermap_GroupObject
**/
class Playermap_GroupObject extends XoopsSimpleObject
{
	const PRIMARY = 'group_id';
	const DATANAME = 'group';

	public $mCircle = array();
	 protected $_mCircleLoadedFlag = false;
	public $mMember = array();
	 protected $_mMemberLoadedFlag = false;
	public $mRecruit = array();
	 protected $_mRecruitLoadedFlag = false;

	/**
	 * __construct
	 * 
	 * @param	void
	 * 
	 * @return	void
	**/
	public function __construct()
	{
		$this->initVar('group_id', XOBJ_DTYPE_INT, '', false);
		$this->initVar('title', XOBJ_DTYPE_STRING, '', false, 255);
		$this->initVar('url', XOBJ_DTYPE_STRING, '', false, 255);
		$this->initVar('description', XOBJ_DTYPE_TEXT, '', false);
		$this->initVar('policy', XOBJ_DTYPE_TEXT, '', false);
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
	 * getPolicy
	 * 
	 * @param	string	$target
	 * @param	Enum	$authType
	 * 
	 * @return	void
	 */
	public function getPolicy(/*** string ***/ $target, /*** Enum ***/ $authType=Pmenum_Permission::READ)
	{
		$policy = unserialize($this->get('policy'));
		$rank = $this->getMyRank();
		return $policy[$target][$rank][$authType];
	}

	/**
	 * getMyRank
	 * 
	 * @param	string	$target
	 * @param	Enum	$authType
	 * 
	 * @return	void
	 */
	public function getMyRank()
	{
		$handler = Legacy_Utils::getModuleHandler('member', $this->getDirname());
		$cri = new CriteriaCompo();
		$cri->add(new Criteria('group_id', $this->get('group_id')));
		$cri->add(new Criteria('uid', Legacy_Utils::getUid()));
		$cri->add(new Criteria('status', Lenum_ProgressStatus::FINISHED));
		$objs = $handler->getObjects($cri);
		if(count($objs)>0){
			return array_shift($objs)->get('rank');
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
		XCube_DelegateUtils::call('Legacy_ImageManager.GetImageObjects', new XCube_Ref($imageObjs), $this->getDirname(), self::DATANAME, $this->get(self::PRIMARY));
		if(count($imageObjs)>0){
			return array_shift($imageObjs);
		}
	}

	/**
	 * loadCircle
	 * 
	 * @param	void
	 * 
	 * @return	void
	 */
	public function loadCircle()
	{
		if ($this->_mCircleLoadedFlag == false) {
			$handler = Legacy_Utils::getModuleHandler('circle', $this->getDirname());
			$this->mCircle =& $handler->get($this->get(self::PRIMARY));
			$this->_mCircleLoadedFlag = true;
		}
	}

	/**
	 * loadMember
	 * 
	 * @param	Enum	$rank
	 * 
	 * @return	void
	 */
	public function loadMember($rank=Pmenum_Member::REGULAR)
	{
		if ($this->_mMemberLoadedFlag == false) {
			$handler = Legacy_Utils::getModuleHandler('member', $this->getDirname());
			$cri = new CriteriaCompo();
			$cri->add(new Criteria(self::PRIMARY, $this->get(self::PRIMARY)));
			$cri->add(new Criteria('rank', $rank, '>='));
			$cri->add(new Criteria('status', Lenum_ProgressStatus::FINISHED));
			$this->mMember =& $handler->getObjects($cri);
			$this->_mMemberLoadedFlag = true;
		}
	}

	/**
	 * loadRecruit
	 * 
	 * @param	void
	 * 
	 * @return	void
	 */
	public function loadRecruit()
	{
		if ($this->_mRecruitLoadedFlag == false) {
			$handler = Legacy_Utils::getModuleHandler('recruit', $this->getDirname());
			$cri = new CriteriaCompo();
			$cri->add(new Criteria(self::PRIMARY, $this->get(self::PRIMARY)));
			$cri->add(new Criteria('endtime', time(), '>'));
			$this->mRecruit =& $handler->getObjects($cri);
			$this->_mRecruitLoadedFlag = true;
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
		case 'member':
			$handler = Legacy_Utils::getModuleHandler($dataname, $this->getDirname());
			$cri = new CriteriaCompo();
			$cri->add(new Criteria(self::PRIMARY, $this->get(self::PRIMARY)));
			$cri->add(new Criteria('rank', $rank, '>='));
			$cri->add(new Criteria('status', Lenum_ProgressStatus::FINISHED));
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
		return Legacy_Utils::renderUri($this->getDirname(), 'group', $this->get(self::PRIMARY));
	}
}

/**
 * Playermap_GroupHandler
**/
class Playermap_GroupHandler extends XoopsObjectGenericHandler
{
	public /*** string ***/ $mTable = '{dirname}_group';

	public /*** string ***/ $mPrimary = 'group_id';

	public /*** string ***/ $mClass = 'Playermap_GroupObject';

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
		if($obj->isNew()){
			$handler = Legacy_Utils::getModuleHandler('member', $this->getDirname());
			$member = $handler->create();
			$member->set('uid', Legacy_Utils::getUid());
			$member->set('group_id', $obj->get('group_id'));
			$member->set('status', Lenum_ProgressStatus::FINISHED);
			$member->set('rank', Pmenum_Member::OWNER);
			$handler->insert($member);
		}
		return $result;
	}

	/**
	 * updatePolicy
	 * 
	 * @param	XoopsSimpleObject	&$obj
	 * @param	mixed[]	$newPermission
	 *	 @param	string	$newPermission['dirname']
	 *	 @param	string	$newPermission['dataname']
	 *	 @param	mixed[]	$newPermission['policy']
	 *	   @param	int	$newPermission['policy'][$actionName]
	 * 
	 * @return	bool
	**/
	public function updatePolicy(/*** XoopsSimpleObject ***/ $obj, $newPermission=null)
	{
		$mHandler = Legacy_Utils::getModuleHandler('member', $this->getDirname());
		$pHandler = Legacy_Utils::getModuleHandler('permission', $this->getDirname());
		$policy = $obj->getPolicy();
		$oldPermission = $policy[$newPermission['dirname']][$newPermission['dataname']];
		if(isset($oldPermission) && isset($newPermission)){	//update
			$obj->setPolicy($policy);
			$this->insert($obj);
			$diff = array_diff_assoc($newPermission['policy'], $oldPermission);
			if(isset($diff['view'])){
				$newV = $diff['view'];
				$oldV = $oldPermission['view'];
				$cri = new CriteriaCompo();
				$cri->add(new Criteria('group_id', $obj->get('group_id')));
				$cri->add(new Criteria('status', Lenum_ProgressStatus::FINISHED));
			
				if($newV>$oldV){	// delete some data
					$cri->add(new Criteria('rank', $newV, '<'));
					$cri->add(new Criteria('rank', $oldV, '>='));
					$objs = $mHandler->getObjects($cri);
					$uidList = array();
					foreach(array_keys($objs) as $key){
						$uidList[] = $objs[$key]->get('uid');
					}
				
					$cri = new CriteriaCompo();
					$cri->add(new Criteria('group_id', $obj->get('group_id')));
					$cri->add(new Criteria('dirname', $newPermission['dirname']));
					$cri->add(new Criteria('dataname', $newPermission['dataname']));
					$cri->add(new Criteria('uid', $uidList, 'IN'));
					$pHandler->deleteAll($cri);
				}
				else{	//insert some data
					$cri->add(new Criteria('rank', $newV, '>='));
					$cri->add(new Criteria('rank', $oldV, '<'));
					$objs = $mHandler->getObjects($cri);
					foreach(array_keys($objs) as $key){
						$pHandler->createPermission($obj->get('group_id'), $objs[$key]->get('uid'), $newPermission['dirname'], $newPermission['dataname']);
					}
				}
			}
		}
		elseif(isset($oldPermission) && ! isset($newPermission)){ //delete
			unset($policy[$newPermission['dirname']][$newPermission['dataname']]);
			$obj->setPolicy($policy);
			$this->insert($obj);
			$cri = new CriteriaCompo();
			$cri->add(new Criteria('group_id', $obj->get('group_id')));
			$cri->add(new Criteria('dirname', $obj->get('dirname')));
			$cri->add(new Criteria('dataname', $obj->get('dataname')));
			$pHandler->deleteAll($cri);
		}
		elseif(! isset($oldPermission) && isset($newPermission)){ //new insert
			$policy[$newPermission['dirname']][$newPermission['dataname']] = $newPermission['policy'];
			$obj->setPolicy($policy);
			$this->insert($obj);
			$uidList = $mHandler->getMemberIdList($obj->get('group_id'), $newPermission['policy']['view']);
			foreach($uidList['uid'] as $uid){
				$pHandler->createPermission($obj->get('group_id'), $uid, $newPermission['dirname'], $newPermission['dataname']);
			}
		}
	}

	/**
	 * getGroupListByIds
	 * 
	 * @param	int[]	$list
	 * 
	 * @return	int[]
	**/
	public function getGroupListByIds(/*** int[] ***/ $list)
	{
		$objs = $this->getObjects(new Criteria($this->mPrimary, $list, 'IN'));
		$ret = array('group_id'=>array(), 'title'=>array(), 'url'=>array());
		foreach(array_keys($objs) as $key){
			$ret['group_id'][] = $objs[$key]->getShow('group_id');
			$ret['title'][] = $objs[$key]->getShow('title');
			$ret['url'][] = Legacy_Utils::renderUri($this->getDirname(), 'group', $objs[$key]->getShow('group_id'));
		}
		return $ret;
	}

	/**
	 * getClientDataList
	 * 
	 * @param	void
	 * 
	 * @return	mixed[]
	**/
	public function getClientDataList()
	{
		$list = array();
		XCube_DelegateUtils::call('Legacy_Group.GetClientDataList', new XCube_Ref($list));
		return $list;
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
		case 'conv':
			$cri->setSort('starttime', 'DESC');
			break;
		case 'member':
			$cri->add(new Criteria('rank', Pmenum_Member::ASSOCIATE, '>='));
			$cri->setSort('posttime', 'ASC');
			break;
		case 'log':
			$cri->setSort('sessiontime', 'DESC');
			break;
		}
	
		$handler = Legacy_Utils::getModuleHandler($childname, $dirname);
		return $handler->getObjects($cri, $limit, $start);
	}
}

?>
