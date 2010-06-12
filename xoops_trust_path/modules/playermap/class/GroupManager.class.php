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
 * Playermap_GroupManager
**/
class Playermap_GroupManager
{
	protected $_mDirname = null;
	protected $_mSetId = 0;
	const VIEW = "view";
	const POST = "post";
	const MANAGE = "manage";

	/**
	 * __construct
	 * 
	 * @param	string	$dirname
	 * @param	int		$setId
	 * @param	string	$catSetName
	 * 
	 * @return	void
	**/
	public function __construct($dirname, $catSetName='cat_id')
	{
		$this->_mDirname = $dirname;
		$this->_mSetId = XCube_Root::getSingleton()->mContext->mModuleConfig[$catSetName];
	}

	/**
	 * check
	 * 
	 * @param	int		$groupId
	 * @param	string	$type
	 * 
	 * @return	string
	**/
	public function check(/*** int ***/ $groupId, /*** string ***/ $type)
	{
		$check = null;
		XCube_DelegateUtils::call('Legacy_Group.isMember', new XCube_Ref($check), $groupId, Legacy_Utils::getUid(), $this->getAuthType($type));
		return $check;
	}

	/**
	 * getTree
	 * 
	 * @param	string	$type
	 * 
	 * @return	string
	**/
	public function getTree($type)
	{
		$tree = array();
		XCube_DelegateUtils::call('Legacy_Category.GetTree', new XCube_Ref($tree), $this->_mSetId, $this->_getAuthType($type), Legacy_Utils::getUid());
		return $tree;
	}

	/**
	 * _getAuthType
	 * 
	 * @param	string $type
	 * 
	 * @return	string
	**/
	protected function _getAuthType(/*** string ***/ $type)
	{
		$authSetting = @XCube_Root::getSingleton()->mContext->mModuleConfig['auth_type'];
		$type = isset($authSetting) ? explode('|', $authSetting) : array('viewer', 'editor', 'manager');
		switch($type){
			case self::VIEW:
				return $authType[0];
				break;
			case self::POST:
				return $authType[1];
				break;
			case self::MANAGE:
				return $authType[2];
				break;
		}
	}

	/**
	 * getTitle
	 * 
	 * @param	int		$catId
	 * 
	 * @return	string
	**/
	public function getTitle(/*** int ***/ $catId)
	{
		$title = null;
		XCube_DelegateUtils::call('Legacy_Group.GetTitle', new XCube_Ref($title), $catId);
		return $title;
	}

	/**
	 * getTitleList
	 * 
	 * @param	void
	 * 
	 * @return	mixed[]
	 *	@params	int		$catId
	 *	@params string	$title
	**/
	public function getTitleList()
	{
		$list = array();
		XCube_DelegateUtils::call('Legacy_Group.GetTitleList', new XCube_Ref($list), $this->_mSetId);
		return $list;
	}

	/**
	 * getPermittedIdList
	 * 
	 * @param	string	$type
	 * @param	int		$catId
	 * 
	 * @return	int[]
	**/
	public function getPermittedIdList(/*** string ***/ $type, /*** int ***/ $catId=0)
	{
		$idList = array();
		XCube_DelegateUtils::call('Legacy_Category.GetMyGroupIdListByDataname', new XCube_Ref($idList), $this->_mSetId, $type);
		return $idList;
	}
}

?>
