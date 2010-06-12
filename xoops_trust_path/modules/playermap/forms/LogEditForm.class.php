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
 * Playermap_LogEditForm
**/
class Playermap_LogEditForm extends XCube_ActionForm
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
		return "module.playermap.LogEditForm.TOKEN";
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
		$this->mFormProperties['log_id'] = new XCube_IntProperty('log_id');
		$this->mFormProperties['title'] = new XCube_StringProperty('title');
		$this->mFormProperties['uid'] = new XCube_IntProperty('uid');
		$this->mFormProperties['rpg_id'] = new XCube_IntProperty('rpg_id');
		$this->mFormProperties['group_id'] = new XCube_IntProperty('group_id');
		$this->mFormProperties['conv_id'] = new XCube_IntProperty('conv_id');
		$this->mFormProperties['sessiontime'] = new XCube_StringProperty('sessiontime');
		$this->mFormProperties['scheduletime'] = new XCube_StringProperty('scheduletime');
		$this->mFormProperties['recruit'] = new XCube_IntProperty('recruit');
		$this->mFormProperties['url'] = new XCube_StringProperty('url');
		$this->mFormProperties['description'] = new XCube_TextProperty('description');
		$this->mFormProperties['posttime'] = new XCube_IntProperty('posttime');
	
		//
		// Set field properties
		//
		$this->mFieldProperties['log_id'] = new XCube_FieldProperty($this);
$this->mFieldProperties['log_id']->setDependsByArray(array('required'));
$this->mFieldProperties['log_id']->addMessage('required', _MD_PLAYERMAP_ERROR_REQUIRED, _MD_PLAYERMAP_LANG_LOG_ID);
		$this->mFieldProperties['title'] = new XCube_FieldProperty($this);
		$this->mFieldProperties['title']->setDependsByArray(array('required','maxlength'));
		$this->mFieldProperties['title']->addMessage('required', _MD_PLAYERMAP_ERROR_REQUIRED, _MD_PLAYERMAP_LANG_TITLE);
		$this->mFieldProperties['title']->addMessage('maxlength', _MD_PLAYERMAP_ERROR_MAXLENGTH, _MD_PLAYERMAP_LANG_TITLE, '255');
		$this->mFieldProperties['title']->addVar('maxlength', '255');
		$this->mFieldProperties['uid'] = new XCube_FieldProperty($this);
		$this->mFieldProperties['rpg_id'] = new XCube_FieldProperty($this);
		$this->mFieldProperties['rpg_id']->setDependsByArray(array('required'));
		$this->mFieldProperties['rpg_id']->addMessage('required', _MD_PLAYERMAP_ERROR_REQUIRED, _MD_PLAYERMAP_LANG_RPG_ID);
		$this->mFieldProperties['group_id'] = new XCube_FieldProperty($this);
		$this->mFieldProperties['conv_id'] = new XCube_FieldProperty($this);
		$this->mFieldProperties['sessiontime'] = new XCube_FieldProperty($this);		$this->mFieldProperties['scheduletime'] = new XCube_FieldProperty($this);
		$this->mFieldProperties['recruit'] = new XCube_FieldProperty($this);
		$this->mFieldProperties['url'] = new XCube_FieldProperty($this);
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
		$this->set('log_id', $obj->get('log_id'));
		$this->set('title', $obj->get('title'));
		$this->set('uid', $obj->get('uid'));
		$this->set('rpg_id', $obj->get('rpg_id'));
		$this->set('group_id', $obj->get('group_id'));
		$this->set('conv_id', $obj->get('conv_id'));
		$this->set('sessiontime', date(_PHPDATEPICKSTRING, $obj->get('sessiontime')));
		$this->set('recruit', $obj->get('recruit'));
		$this->set('url', $obj->get('url'));
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
		$obj->set('title', $this->get('title'));
		$obj->set('rpg_id', $this->get('rpg_id'));
		$obj->set('group_id', $this->get('group_id'));
		$obj->set('conv_id', $this->get('conv_id'));
		$obj->set('sessiontime', $this->_makeUnixtime('sessiontime'));
		$obj->set('scheduletime', $this->_makeUnixtime('scheduletime'));
		$obj->set('recruit', $this->get('recruit'));
		$obj->set('url', $this->get('url'));
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
