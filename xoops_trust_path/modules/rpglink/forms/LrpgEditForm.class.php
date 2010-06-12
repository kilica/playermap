<?php
/**
 * @file
 * @package rpglink
 * @version $Id$
**/

if(!defined('XOOPS_ROOT_PATH'))
{
	exit;
}

require_once XOOPS_ROOT_PATH . '/core/XCube_ActionForm.class.php';
require_once XOOPS_MODULE_PATH . '/legacy/class/Legacy_Validator.class.php';

/**
 * Rpglink_LrpgEditForm
**/
class Rpglink_LrpgEditForm extends XCube_ActionForm
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
		return "module.rpglink.LrpgEditForm.TOKEN";
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
		$this->mFormProperties['lrpg_id'] = new XCube_IntProperty('lrpg_id');
		$this->mFormProperties['rpg_id'] = new XCube_IntProperty('rpg_id');
		$this->mFormProperties['link_id'] = new XCube_IntProperty('link_id');
		$this->mFormProperties['posttime'] = new XCube_IntProperty('posttime');

	
		//
		// Set field properties
		//
		$this->mFieldProperties['lrpg_id'] = new XCube_FieldProperty($this);
$this->mFieldProperties['lrpg_id']->setDependsByArray(array('required'));
$this->mFieldProperties['lrpg_id']->addMessage('required', _MD_RPGLINK_ERROR_REQUIRED, _MD_RPGLINK_LANG_LRPG_ID);
		$this->mFieldProperties['rpg_id'] = new XCube_FieldProperty($this);
$this->mFieldProperties['rpg_id']->setDependsByArray(array('required'));
$this->mFieldProperties['rpg_id']->addMessage('required', _MD_RPGLINK_ERROR_REQUIRED, _MD_RPGLINK_LANG_RPG_ID);
		$this->mFieldProperties['link_id'] = new XCube_FieldProperty($this);
$this->mFieldProperties['link_id']->setDependsByArray(array('required'));
$this->mFieldProperties['link_id']->addMessage('required', _MD_RPGLINK_ERROR_REQUIRED, _MD_RPGLINK_LANG_LINK_ID);
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
		$this->set('lrpg_id', $obj->get('lrpg_id'));
		$this->set('rpg_id', $obj->get('rpg_id'));
		$this->set('link_id', $obj->get('link_id'));
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
		$obj->set('rpg_id', $this->get('rpg_id'));
		$obj->set('link_id', $this->get('link_id'));

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
