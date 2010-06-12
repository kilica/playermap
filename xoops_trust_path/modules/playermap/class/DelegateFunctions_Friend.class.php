<?php
/**
 * @package playermap
 */

if (!defined('XOOPS_ROOT_PATH')) exit();

class Playermap_FriendDelegate extends Legacy_AbstractFriendDelegate
{
	/**
	 * getFriendIdList Legacy_Friend.GetFriendIdList
	 *
	 * @param int[] &$list
	 * @param int	$uid
	 *
	 * @return	void
	 */ 
	public function getFriendIdList(/*** int[] ***/ &$list, /*** int ***/ $uid)
	{
		$handler = Legacy_Utils::getModuleHandler('conne', LEGACY_FRIEND_DIRNAME);
		$list = $handler->getFriendIdList($uid);
	}

	/**
	 * isFriend 	Legacy_Friend.IsFriend
	 * check she is a friend
	 *
	 * @param bool	&$check
	 * @param int	$uid
	 * @param int	$friend_uid
	 *
	 * @return	void
	 */ 
	public function isFriend(/*** bool ***/ &$check, /*** int ***/ $uid, /*** int ***/ $friend_uid)
	{
		$handler = Legacy_Utils::getModuleHandler('conne', LEGACY_FRIEND_DIRNAME);
		$check = $handler->isFriend($uid, $friend_uid);
	}

	/**
	 * getMyFriendsActivitiesList 	Legacy_Friend.GetFriendsActivitiesList
	 * get friends recent action list
	 *
	 * @param Legacy_AbstractUserActivityObject[] &$actionList
	 * @param int	$uid
	 * @param int	$limit
	 * @param int	$start
	 *
	 * @return	void
	 */ 
	public function getMyFriendsActivitiesList(/*** Legacy_AbstractUserActivityObject[] ***/ &$actionList, /*** int ***/ $uid, /*** int ***/ $limit=20, /*** int ***/ $start=0)
	{
	}
}

?>
