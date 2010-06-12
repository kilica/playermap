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
 * Playermap_CircleEditForm
**/
class Playermap_CircleEditForm extends XCube_ActionForm
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
		return "module.playermap.CircleEditForm.TOKEN";
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
		$this->mFormProperties['group_id'] = new XCube_IntProperty('group_id');
		$this->mFormProperties['address'] = new XCube_TextProperty('address');
		$this->mFormProperties['pref_id'] = new XCube_IntProperty('pref_id');
		$this->mFormProperties['grp'] = new XCube_FloatProperty('grp');
		$this->mFormProperties['sun'] = new XCube_IntProperty('sun');
		$this->mFormProperties['mon'] = new XCube_IntProperty('mon');
		$this->mFormProperties['tue'] = new XCube_IntProperty('tue');
		$this->mFormProperties['wed'] = new XCube_IntProperty('wed');
		$this->mFormProperties['thu'] = new XCube_IntProperty('thu');
		$this->mFormProperties['fri'] = new XCube_IntProperty('fri');
		$this->mFormProperties['sat'] = new XCube_IntProperty('sat');
		$this->mFormProperties['hol'] = new XCube_IntProperty('hol');
		$this->mFormProperties['pbn'] = new XCube_IntProperty('pbn');
		$this->mFormProperties['posttime'] = new XCube_IntProperty('posttime');

	
		//
		// Set field properties
		//
		$this->mFieldProperties['group_id'] = new XCube_FieldProperty($this);
		$this->mFieldProperties['group_id']->setDependsByArray(array('required'));
		$this->mFieldProperties['group_id']->addMessage('required', _MD_PLAYERMAP_ERROR_REQUIRED, _MD_PLAYERMAP_LANG_GROUP_ID);
		$this->mFieldProperties['address'] = new XCube_FieldProperty($this);
		$this->mFieldProperties['pref_id'] = new XCube_FieldProperty($this);
		$this->mFieldProperties['pref_id']->setDependsByArray(array('required'));
		$this->mFieldProperties['pref_id']->addMessage('required', _MD_PLAYERMAP_ERROR_REQUIRED, _MD_PLAYERMAP_LANG_PREF_ID);
		$this->mFieldProperties['grp'] = new XCube_FieldProperty($this);
		$this->mFieldProperties['grp']->setDependsByArray(array('required'));
		$this->mFieldProperties['grp']->addMessage('required', _MD_PLAYERMAP_ERROR_REQUIRED, _MD_PLAYERMAP_LANG_GRP);
		$this->mFieldProperties['sun'] = new XCube_FieldProperty($this);
		$this->mFieldProperties['sun']->setDependsByArray(array('required'));
		$this->mFieldProperties['sun']->addMessage('required', _MD_PLAYERMAP_ERROR_REQUIRED, _MD_PLAYERMAP_LANG_SUN);
		$this->mFieldProperties['mon'] = new XCube_FieldProperty($this);
		$this->mFieldProperties['mon']->setDependsByArray(array('required'));
		$this->mFieldProperties['mon']->addMessage('required', _MD_PLAYERMAP_ERROR_REQUIRED, _MD_PLAYERMAP_LANG_MON);
		$this->mFieldProperties['tue'] = new XCube_FieldProperty($this);
		$this->mFieldProperties['tue']->setDependsByArray(array('required'));
		$this->mFieldProperties['tue']->addMessage('required', _MD_PLAYERMAP_ERROR_REQUIRED, _MD_PLAYERMAP_LANG_TUE);
		$this->mFieldProperties['wed'] = new XCube_FieldProperty($this);
		$this->mFieldProperties['wed']->setDependsByArray(array('required'));
		$this->mFieldProperties['wed']->addMessage('required', _MD_PLAYERMAP_ERROR_REQUIRED, _MD_PLAYERMAP_LANG_WED);
		$this->mFieldProperties['thu'] = new XCube_FieldProperty($this);
		$this->mFieldProperties['thu']->setDependsByArray(array('required'));
		$this->mFieldProperties['thu']->addMessage('required', _MD_PLAYERMAP_ERROR_REQUIRED, _MD_PLAYERMAP_LANG_THU);
		$this->mFieldProperties['fri'] = new XCube_FieldProperty($this);
		$this->mFieldProperties['fri']->setDependsByArray(array('required'));
		$this->mFieldProperties['fri']->addMessage('required', _MD_PLAYERMAP_ERROR_REQUIRED, _MD_PLAYERMAP_LANG_FRI);
		$this->mFieldProperties['sat'] = new XCube_FieldProperty($this);
		$this->mFieldProperties['sat']->setDependsByArray(array('required'));
		$this->mFieldProperties['sat']->addMessage('required', _MD_PLAYERMAP_ERROR_REQUIRED, _MD_PLAYERMAP_LANG_SAT);
		$this->mFieldProperties['hol'] = new XCube_FieldProperty($this);
		$this->mFieldProperties['hol']->setDependsByArray(array('required'));
		$this->mFieldProperties['hol']->addMessage('required', _MD_PLAYERMAP_ERROR_REQUIRED, _MD_PLAYERMAP_LANG_HOL);
		$this->mFieldProperties['pbn'] = new XCube_FieldProperty($this);
		$this->mFieldProperties['pbn']->setDependsByArray(array('required'));
		$this->mFieldProperties['pbn']->addMessage('required', _MD_PLAYERMAP_ERROR_REQUIRED, _MD_PLAYERMAP_LANG_PBN);
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
		$this->set('group_id', $obj->get('group_id'));
		$this->set('address', $obj->get('address'));
		$this->set('pref_id', $obj->get('pref_id'));
		$this->set('sun', $obj->get('sun'));
		$this->set('mon', $obj->get('mon'));
		$this->set('tue', $obj->get('tue'));
		$this->set('wed', $obj->get('wed'));
		$this->set('thu', $obj->get('thu'));
		$this->set('fri', $obj->get('fri'));
		$this->set('sat', $obj->get('sat'));
		$this->set('hol', $obj->get('hol'));
		$this->set('pbn', $obj->get('pbn'));
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
		$obj->set('address', $this->get('address'));
		$obj->set('pref_id', $this->get('pref_id'));
		$obj->set('grp_lat', $this->get('grp_lat'));
		$obj->set('sun', $this->get('sun'));
		$obj->set('mon', $this->get('mon'));
		$obj->set('tue', $this->get('tue'));
		$obj->set('wed', $this->get('wed'));
		$obj->set('thu', $this->get('thu'));
		$obj->set('fri', $this->get('fri'));
		$obj->set('sat', $this->get('sat'));
		$obj->set('hol', $this->get('hol'));
		$obj->set('pbn', $this->get('pbn'));

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
