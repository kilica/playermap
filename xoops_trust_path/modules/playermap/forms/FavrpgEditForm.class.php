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
 * Playermap_FavrpgEditForm
**/
class Playermap_FavrpgEditForm extends XCube_ActionForm
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
		return "module.playermap.FavrpgEditForm.TOKEN";
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
		$this->mFormProperties['favrpg_id'] = new XCube_IntProperty('favrpg_id');
		$this->mFormProperties['rpg_id'] = new XCube_IntProperty('rpg_id');
		$this->mFormProperties['uid'] = new XCube_IntProperty('uid');
		$this->mFormProperties['rating'] = new XCube_IntProperty('rating');
		$this->mFormProperties['player'] = new XCube_IntProperty('player');
		$this->mFormProperties['master'] = new XCube_IntProperty('master');
		$this->mFormProperties['since'] = new XCube_IntProperty('since');
		$this->mFormProperties['owner'] = new XCube_BoolProperty('owner');
		$this->mFormProperties['description'] = new XCube_TextProperty('description');
		$this->mFormProperties['posttime'] = new XCube_IntProperty('posttime');

	
		//
		// Set field properties
		//
		$this->mFieldProperties['favrpg_id'] = new XCube_FieldProperty($this);
		$this->mFieldProperties['favrpg_id']->setDependsByArray(array('required'));
		$this->mFieldProperties['favrpg_id']->addMessage('required', _MD_PLAYERMAP_ERROR_REQUIRED, _MD_PLAYERMAP_LANG_FAVRPG_ID);
		$this->mFieldProperties['rpg_id'] = new XCube_FieldProperty($this);
		$this->mFieldProperties['rpg_id']->setDependsByArray(array('required'));
		$this->mFieldProperties['rpg_id']->addMessage('required', _MD_PLAYERMAP_ERROR_REQUIRED, _MD_PLAYERMAP_LANG_RPG_ID);
		$this->mFieldProperties['uid'] = new XCube_FieldProperty($this);
		$this->mFieldProperties['rating'] = new XCube_FieldProperty($this);
		$this->mFieldProperties['rating']->setDependsByArray(array('required'));
		$this->mFieldProperties['rating']->addMessage('required', _MD_PLAYERMAP_ERROR_REQUIRED, _MD_PLAYERMAP_LANG_RATING);
		$this->mFieldProperties['player'] = new XCube_FieldProperty($this);
		$this->mFieldProperties['master'] = new XCube_FieldProperty($this);
		$this->mFieldProperties['owner'] = new XCube_FieldProperty($this);
		$this->mFieldProperties['description'] = new XCube_FieldProperty($this);
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
		$this->set('favrpg_id', $obj->get('favrpg_id'));
		$this->set('rpg_id', $obj->get('rpg_id'));
		$this->set('uid', $obj->get('uid'));
		$this->set('rating', $obj->get('rating'));
		$this->set('player', $obj->get('player'));
		$this->set('master', $obj->get('master'));
		$this->set('since', $obj->get('since'));
		$this->set('owner', $obj->get('owner'));
		$this->set('description', $obj->get('description'));
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
		$obj->set('rating', $this->get('rating'));
		$obj->set('player', $this->get('player'));
		$obj->set('master', $this->get('master'));
		//$obj->set('since', $this->get('since'));
		$obj->set('owner', $this->get('owner'));
		$obj->set('description', $textFilter = XCube_Root::getSingleton()->getTextFilter()->purifyHtml($this->get('description')));
;

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
