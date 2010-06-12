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
 * Playermap_GroupEditForm
**/
class Playermap_GroupEditForm extends XCube_ActionForm
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
		return "module.playermap.GroupEditForm.TOKEN";
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
		$this->mFormProperties['title'] = new XCube_StringProperty('title');
		$this->mFormProperties['url'] = new XCube_StringProperty('url');
		$this->mFormProperties['description'] = new XCube_TextProperty('description');
		$this->mFormProperties['policy'] = new XCube_TextProperty('policy');
		$this->mFormProperties['posttime'] = new XCube_IntProperty('posttime');

	
		//
		// Set field properties
		//
		$this->mFieldProperties['group_id'] = new XCube_FieldProperty($this);
$this->mFieldProperties['group_id']->setDependsByArray(array('required'));
$this->mFieldProperties['group_id']->addMessage('required', _MD_PLAYERMAP_ERROR_REQUIRED, _MD_PLAYERMAP_LANG_GROUP_ID);
		$this->mFieldProperties['title'] = new XCube_FieldProperty($this);
		$this->mFieldProperties['title']->setDependsByArray(array('required','maxlength'));
		$this->mFieldProperties['title']->addMessage('required', _MD_PLAYERMAP_ERROR_REQUIRED, _MD_PLAYERMAP_LANG_TITLE);
		$this->mFieldProperties['title']->addMessage('maxlength', _MD_PLAYERMAP_ERROR_MAXLENGTH, _MD_PLAYERMAP_LANG_TITLE, '255');
		$this->mFieldProperties['title']->addVar('maxlength', '255');
		$this->mFieldProperties['url'] = new XCube_FieldProperty($this);
		$this->mFieldProperties['description'] = new XCube_FieldProperty($this);
		$this->mFieldProperties['policy'] = new XCube_FieldProperty($this);
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
		$this->set('title', $obj->get('title'));
		$this->set('url', $obj->get('url'));
		$this->set('description', $obj->get('description'));
		$this->set('policy', $obj->get('policy'));
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
		$obj->set('url', $this->get('url'));
		$obj->set('description', $textFilter = XCube_Root::getSingleton()->getTextFilter()->purifyHtml($this->get('description')));
;
		$obj->set('policy', $this->get('policy'));

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
