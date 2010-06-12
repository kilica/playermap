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
 * Rpglink_UpdateEditForm
**/
class Rpglink_UpdateEditForm extends XCube_ActionForm
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
		return "module.rpglink.UpdateEditForm.TOKEN";
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
		$this->mFormProperties['update_id'] = new XCube_IntProperty('update_id');
		$this->mFormProperties['title'] = new XCube_StringProperty('title');
		$this->mFormProperties['link_id'] = new XCube_IntProperty('link_id');
		$this->mFormProperties['url'] = new XCube_StringProperty('url');
		$this->mFormProperties['update_time'] = new XCube_StringProperty('update_time');
		$this->mFormProperties['description'] = new XCube_TextProperty('description');
		$this->mFormProperties['posttime'] = new XCube_IntProperty('posttime');

	
		//
		// Set field properties
		//
		$this->mFieldProperties['update_id'] = new XCube_FieldProperty($this);
$this->mFieldProperties['update_id']->setDependsByArray(array('required'));
$this->mFieldProperties['update_id']->addMessage('required', _MD_RPGLINK_ERROR_REQUIRED, _MD_RPGLINK_LANG_UPDATE_ID);
		$this->mFieldProperties['title'] = new XCube_FieldProperty($this);
		$this->mFieldProperties['title']->setDependsByArray(array('required','maxlength'));
		$this->mFieldProperties['title']->addMessage('required', _MD_RPGLINK_ERROR_REQUIRED, _MD_RPGLINK_LANG_TITLE);
		$this->mFieldProperties['title']->addMessage('maxlength', _MD_RPGLINK_ERROR_MAXLENGTH, _MD_RPGLINK_LANG_TITLE, '255');
		$this->mFieldProperties['title']->addVar('maxlength', '255');
		$this->mFieldProperties['link_id'] = new XCube_FieldProperty($this);
$this->mFieldProperties['link_id']->setDependsByArray(array('required'));
$this->mFieldProperties['link_id']->addMessage('required', _MD_RPGLINK_ERROR_REQUIRED, _MD_RPGLINK_LANG_LINK_ID);
		$this->mFieldProperties['url'] = new XCube_FieldProperty($this);
		$this->mFieldProperties['url']->setDependsByArray(array('required','maxlength'));
		$this->mFieldProperties['url']->addMessage('required', _MD_RPGLINK_ERROR_REQUIRED, _MD_RPGLINK_LANG_URL);
		$this->mFieldProperties['url']->addMessage('maxlength', _MD_RPGLINK_ERROR_MAXLENGTH, _MD_RPGLINK_LANG_URL, '255');
		$this->mFieldProperties['url']->addVar('maxlength', '255');
		$this->mFieldProperties['update_time'] = new XCube_FieldProperty($this);		$this->mFieldProperties['description'] = new XCube_FieldProperty($this);
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
		$this->set('update_id', $obj->get('update_id'));
		$this->set('title', $obj->get('title'));
		$this->set('link_id', $obj->get('link_id'));
		$this->set('url', $obj->get('url'));
		$this->set('update_time', date(_PHPDATEPICKSTRING, $obj->get('update_time')));
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
		$obj->set('link_id', $this->get('link_id'));
		$obj->set('url', $this->get('url'));
		$obj->set('update_time', $this->_makeUnixtime('update_time'));
		$obj->set('description', $textFilter = XCube_Root::getSingleton()->getTextFilter()->purifyHtml($this->get('description')));

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
