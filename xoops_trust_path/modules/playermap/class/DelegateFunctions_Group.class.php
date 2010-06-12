<?php
/**
 * @package playermap
 */

if (!defined('XOOPS_ROOT_PATH')) exit();

/**
 * group delegate
**/
class Playermap_GroupDelegate extends Legacy_AbstractGroupDelegate
{
	/**
	 * getMyGroupIdList Legacy_Group.GetMyGroupIdList
	 *
	 * @param XoopsSimpleObject[] &$list
	 * @param Enum	$rank	Lenum_GroupRank
	 *
	 * @return	void
	 */ 
	public function getMyGroupIdList(/*** int[] ***/ &$list, /*** Enum ***/ $rank)
	{
		$handler = Legacy_Utils::getModuleHandler('member', LEGACY_GROUP_DIRNAME);
		$list = $handler->getMyGroupIdList($rank);
	}

	/**
	 * getMyGroupList Legacy_Group.GetMyGroupList
	 *
	 * @param mixed[] &$list
	 *	  $list['group_id'][]	int
	 *	  $list['title'][]		string
	 *	  $list['url'][]		string
	 * @param Enum	$rank	Lenum_GroupRank
	 * @param int	$limit
	 * @param int	$start
	 *
	 * @return	void
	 */ 
	public function getMyGroupList(/*** mixed[] ***/ &$list, /*** Enum ***/ $rank, /*** int ***/ $limit=20, /*** int ***/ $start=0)
	{
		$handler = Legacy_Utils::getModuleHandler('member', LEGACY_GROUP_DIRNAME);
		$idList = array_slice($handler->getMyGroupIdList($rank), $start, $limit);
		$handler = Legacy_Utils::getModuleHandler('group', LEGACY_GROUP_DIRNAME);
		$list = $handler->getGroupListByIds($idList);
	}

	/**
	 * getMemberList	  Legacy_Group.GetMemberList
	 * get member list in the given group
	 *
	 * @param mixed $list
	 *	$list['uid']
	 *	$list['rank']
	 * @param int	$groupId
	 * @param Enum	$rank	Lenum_GroupRank
	 *
	 * @return	void
	 */ 
	public function getMemberList(/*** int[] ***/ &$list, /*** int ***/ $groupId, /*** Enum ***/ $rank)
	{
		$handler = Legacy_Utils::getModuleHandler('member', LEGACY_GROUP_DIRNAME);
		$list = $handler->getMemberIdList($groupId, $rank);
	}

	/**
	 * isMember 	 Legacy_Group.IsMember
	 * check the user's belonging and rank in the given group
	 *
	 * @param bool	&$check
	 * @param int	$groupId
	 * @param int	$uid
	 * @param Enum	$rank	Lenum_GroupRank
	 *
	 * @return	void
	 */ 
	public function isMember(/*** bool ***/ &$check, /*** int ***/ $groupId, /*** int ***/ $uid, /*** Enum ***/ $rank=Lenum_GroupRank::REGULAR)
	{
		$handler = Legacy_Utils::getModuleHandler('member', LEGACY_GROUP_DIRNAME);
		$check = $handler->isMember($groupId, $uid, $rank);
	}

	/**
	 * getMyGroupsActivitiesList 	Legacy_Group.GetGroupActivitiesList
	 * get friends recent action list
	 *
	 * @param Legacy_AbstractGroupActivityObject[] &$actionList
	 * @param int	$uid
	 * @param int	$limit
	 * @param int	$start
	 *
	 * @return	void
	 */ 
	public function getMyGroupsActivitiesList(/*** Legacy_AbstractGroupActivityObject[] ***/ &$actionList, /*** int ***/ $uid, /*** int ***/ $limit=20, /*** int ***/ $start=0)
	{
	}
}

/**
 * group client delegate
**/
class Playermap_GroupClientDelegate
{
	public function getGroupClientList(&$list)
	{
		$dirnames = Legacy_Utils::getDirnameListByTrustDirname('log');
		foreach($dirnames as $dirname){
			$list[] = array('dirname'=>$dirname, 'dataname'=>'log');
		}
	}
}
?>
