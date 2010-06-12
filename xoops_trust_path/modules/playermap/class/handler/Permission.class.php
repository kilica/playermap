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
 * Playermap_PermissionObject
**/
class Playermap_PermissionObject extends XoopsSimpleObject
{
	const PRIMARY = 'permission_id';
	const DATANAME = 'permission';
	public $mPrimary = 'permission_id';
	public $mDataname = 'permission';

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
		$this->initVar('permission_id', XOBJ_DTYPE_INT, '', false);
		$this->initVar('group_id', XOBJ_DTYPE_INT, 0, false);
		$this->initVar('uid', XOBJ_DTYPE_INT, 0, false);
		$this->initVar('dirname', XOBJ_DTYPE_STRING, '', false, 64);
		$this->initVar('dataname', XOBJ_DTYPE_STRING, '', false, 64);
	}
}

/**
 * Playermap_PermissionHandler
**/
class Playermap_PermissionHandler extends XoopsObjectGenericHandler
{
	public /*** string ***/ $mTable = '{dirname}_permission';

	public /*** string ***/ $mPrimary = 'permission_id';

	public /*** string ***/ $mClass = 'Playermap_PermissionObject';

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
	 * getMyGroupIdListByDataname
	 * 
	 * @param	string	$dirname
	 * @param	string	$dataname
	 * 
	 * @return	int[]
	**/
	public function getMyGroupIdListByDataname(/*** string ***/ $dirname, /*** string ***/ $dataname)
	{
		$cri = new CriteriaCompo();
		$cri->add(new Criteria('dirname', $dirname));
		$cri->add(new Criteria('dataname', $dataname));
		$cri->add(new Criteria('uid', Legacy_Utils::getUid()));
		$objs = $this->geObjects($cri);
		foreach(array_keys($objs) as $key){
			$ret[] = $objs[$key]->get('group_id');
		}
		return $ret;
	}

	/**
	 * insertPermission
	 * 
	 * @param	int		$groupId
	 * @param	int		$uid
	 * @param	string	$dirname
	 * @param	string	$dataname
	 * 
	 * @return	int[]
	**/
	public insertPermission(/*** int ***/ $groupId, /*** int ***/ $uid, /*** string ***/ $dirname, /*** string ***/ $dataname)
	{
		$cri = new CriteriaCompo();
		$cri->set('group_id', $groupId);
		$cri->set('uid', $uid);
		$cri->set('dirname', $dirname);
		$cri->set('dataname', $dataname);
		$objs = $handler->getObjects($cri);
		if(count($objs)==1){
			$permission = array_shift($objs);
		}
		else{
			$permission = $this->create();
			$permission->set('group_id', $groupId);
			$permission->set('uid', $uid);
			$permission->set('dirname', $dirname);
			$permission->set('dataname', $dataname);
		}
		return $this->insert($permission);
	}
}

?>
