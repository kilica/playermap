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

require_once XOOPS_ROOT_PATH . '/core/XCube_ActionForm.class.php';
require_once XOOPS_MODULE_PATH . '/legacy/class/Legacy_Validator.class.php';

/**
 * Playermap_MemberEditForm
**/
class Playermap_MemberEditForm extends XCube_ActionForm
{
	/**
	 * getTokenName
	 * 
	 * @param	void
	 * 
	 * @return	string
	**/
	public function getTokenName()
	{
		return "module.playermap.MemberEditForm.TOKEN";
	}

	/**
	 * prepare
	 * 
	 * @param	void
	 * 
	 * @return	void
	**/
	public function prepare()
	{
		//
		// Set form properties
		//
		$this->mFormProperties['member_id'] = new XCube_IntProperty('member_id');
		$this->mFormProperties['group_id'] = new XCube_IntProperty('group_id');
		$this->mFormProperties['uid'] = new XCube_IntProperty('uid');
		$this->mFormProperties['status'] = new XCube_IntProperty('status');
		$this->mFormProperties['since'] = new XCube_IntProperty('since');
		$this->mFormProperties['rank'] = new XCube_IntProperty('rank');
		$this->mFormProperties['posttime'] = new XCube_IntProperty('posttime');

	
		//
		// Set field properties
		//
		$this->mFieldProperties['member_id'] = new XCube_FieldProperty($this);
		$this->mFieldProperties['member_id']->setDependsByArray(array('required'));
		$this->mFieldProperties['member_id']->addMessage('required', _MD_PLAYERMAP_ERROR_REQUIRED, _MD_PLAYERMAP_LANG_MEMBER_ID);
		$this->mFieldProperties['group_id'] = new XCube_FieldProperty($this);
		$this->mFieldProperties['group_id']->setDependsByArray(array('required'));
		$this->mFieldProperties['group_id']->addMessage('required', _MD_PLAYERMAP_ERROR_REQUIRED, _MD_PLAYERMAP_LANG_GROUP_ID);
		$this->mFieldProperties['uid'] = new XCube_FieldProperty($this);
		$this->mFieldProperties['status'] = new XCube_FieldProperty($this);
		$this->mFieldProperties['since'] = new XCube_FieldProperty($this);
		$this->mFieldProperties['rank'] = new XCube_FieldProperty($this);
		$this->mFieldProperties['posttime'] = new XCube_FieldProperty($this);
	}

	/**
	 * load
	 * 
	 * @param	XoopsSimpleObject  &$obj
	 * 
	 * @return	void
	**/
	public function load(/*** XoopsSimpleObject ***/ &$obj)
	{
		$this->set('member_id', $obj->get('member_id'));
		$this->set('group_id', $obj->get('group_id'));
		$this->set('uid', $obj->get('uid'));
		$this->set('status', $obj->get('status'));
		$this->set('since', $obj->get('since'));
		$this->set('rank', $obj->get('rank'));
		$this->set('posttime', $obj->get('posttime'));

	}

	/**
	 * update
	 * 
	 * @param	XoopsSimpleObject  &$obj
	 * 
	 * @return	void
	**/
	public function update(/*** XoopsSimpleObject ***/ &$obj)
	{
		$obj->set('group_id', $this->get('group_id'));
		$obj->set('since', $this->get('since'));
		$obj->set('rank', $this->get('rank'));

	}

	/**
	 * _makeUnixtime
	 * 
	 * @param	string	$key
	 * 
	 * @return	void
	**/
	protected function _makeUnixtime($key)
	{
		$timeArray = explode('-', $this->get($key));
		return mktime(0, 0, 0, $timeArray[1], $timeArray[2], $timeArray[0]);
	}
}

?>
