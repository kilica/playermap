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
 * Playermap_ConneEditForm
**/
class Playermap_ConneEditForm extends XCube_ActionForm
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
		return "module.playermap.ConneEditForm.TOKEN";
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
		$this->mFormProperties['conne_id'] = new XCube_IntProperty('conne_id');
		$this->mFormProperties['uid'] = new XCube_IntProperty('uid');
		$this->mFormProperties['conne_uid'] = new XCube_IntProperty('conne_uid');
		$this->mFormProperties['level'] = new XCube_IntProperty('level');
		$this->mFormProperties['stat'] = new XCube_IntProperty('stat');
		$this->mFormProperties['accepttime'] = new XCube_IntProperty('accepttime');
		$this->mFormProperties['posttime'] = new XCube_IntProperty('posttime');

	
		//
		// Set field properties
		//
		$this->mFieldProperties['conne_id'] = new XCube_FieldProperty($this);
		$this->mFieldProperties['conne_id']->setDependsByArray(array('required'));
		$this->mFieldProperties['conne_id']->addMessage('required', _MD_PLAYERMAP_ERROR_REQUIRED, _MD_PLAYERMAP_LANG_CONNE_ID);
		$this->mFieldProperties['uid'] = new XCube_FieldProperty($this);
		$this->mFieldProperties['conne_uid'] = new XCube_FieldProperty($this);
		$this->mFieldProperties['conne_uid']->setDependsByArray(array('required'));
		$this->mFieldProperties['conne_uid']->addMessage('required', _MD_PLAYERMAP_ERROR_REQUIRED, _MD_PLAYERMAP_LANG_CONNE_UID);
		$this->mFieldProperties['level'] = new XCube_FieldProperty($this);
		$this->mFieldProperties['level']->setDependsByArray(array('required'));
		$this->mFieldProperties['level']->addMessage('required', _MD_PLAYERMAP_ERROR_REQUIRED, _MD_PLAYERMAP_LANG_LEVEL);
		$this->mFieldProperties['stat'] = new XCube_FieldProperty($this);
		$this->mFieldProperties['accepttime'] = new XCube_FieldProperty($this);			$this->mFieldProperties['posttime'] = new XCube_FieldProperty($this);
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
		$this->set('conne_id', $obj->get('conne_id'));
		$this->set('uid', $obj->get('uid'));
		$this->set('conne_uid', $obj->get('conne_uid'));
		$this->set('level', $obj->get('level'));
		$this->set('stat', $obj->get('stat'));
		$this->set('accepttime', $obj->get('accepttime'));
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
		$obj->set('conne_uid', $this->get('conne_uid'));
		$obj->set('level', $this->get('level'));
		$obj->set('stat', $this->get('stat'));

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
