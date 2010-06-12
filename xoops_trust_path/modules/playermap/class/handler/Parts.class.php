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
 * Playermap_PartsObject
**/
class Playermap_PartsObject extends XoopsSimpleObject
{
	public $mObject = null;

	/**
	 * __construct
	 * 
	 * @param	void
	 * 
	 * @return	void
	**/
	public function __construct()
	{
		$this->initVar('parts_id', XOBJ_DTYPE_INT, '', false);
		$this->initVar('dirname', XOBJ_DTYPE_STRING, '', false);
		$this->initVar('dataname', XOBJ_DTYPE_STRING, '', false);
		$this->initVar('data_id', XOBJ_DTYPE_INT, '', false);
		$this->initVar('title', XOBJ_DTYPE_STRING, '', false);
		$this->initVar('url', XOBJ_DTYPE_STRING, '', false);
		$this->initVar('imageTag', XOBJ_DTYPE_STRING, '', false);
		$this->initVar('uid', XOBJ_DTYPE_INT, time(), false);
		$this->initVar('description', XOBJ_DTYPE_TEXT, '', false);
		$this->initVar('subinfo', XOBJ_DTYPE_TEXT, '', false);
		$this->initVar('pubtime', XOBJ_DTYPE_INT, time(), false);
	}

	/**
	 * setup
	 * 
	 * @param	XoopsSimpleObject
	 * @param	XoopsSimpleObject
	 * 
	 * @return	void
	**/
	public function setup(/*** XoopsSimpleObject ***/ $obj, /*** string ***/ $parentname)
	{
		$this->mObject = $obj;
	
		$this->set('dirname', $obj->getDirname());
		$this->set('dataname', $parentname);
		$this->set('data_id', $obj->getCommonValue('data_id'));
		$this->set('title', $obj->getCommonValue('title', $parentname));
		$this->set('url', $obj->getCommonValue('url', $parentname));
		$this->set('imageTag', $obj->getCommonValue('imageTag', $parentname));
		$this->set('uid', $obj->getCommonValue('uid'));
		$this->set('description', $obj->getCommonValue('description', $parentname));
		$this->set('subinfo', $obj->getCommonValue('subinfo', $parentname));
		$this->set('pubtime', $obj->getCommonValue('pubtime'));
	}
}

/**
 * Playermap_PartsHandler
**/
class Playermap_PartsHandler extends XoopsObjectGenericHandler
{
	public /*** string ***/ $mTable = '{dirname}_parts';

	public /*** string ***/ $mPrimary = 'parts_id';

	public /*** string ***/ $mClass = 'Playermap_PartsObject';

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
