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
 * Playermap_RecruitEditForm
**/
class Playermap_RecruitEditForm extends XCube_ActionForm
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
		return "module.playermap.RecruitEditForm.TOKEN";
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
		$this->mFormProperties['recruit_id'] = new XCube_IntProperty('recruit_id');
		$this->mFormProperties['title'] = new XCube_StringProperty('title');
		$this->mFormProperties['uid'] = new XCube_IntProperty('uid');
		$this->mFormProperties['group_id'] = new XCube_IntProperty('group_id');
		$this->mFormProperties['endtime'] = new XCube_StringProperty('endtime');
		$this->mFormProperties['description'] = new XCube_TextProperty('description');
		$this->mFormProperties['posttime'] = new XCube_IntProperty('posttime');

	
		//
		// Set field properties
		//
		$this->mFieldProperties['recruit_id'] = new XCube_FieldProperty($this);
$this->mFieldProperties['recruit_id']->setDependsByArray(array('required'));
$this->mFieldProperties['recruit_id']->addMessage('required', _MD_PLAYERMAP_ERROR_REQUIRED, _MD_PLAYERMAP_LANG_RECRUIT_ID);
		$this->mFieldProperties['title'] = new XCube_FieldProperty($this);
		$this->mFieldProperties['title']->setDependsByArray(array('required','maxlength'));
		$this->mFieldProperties['title']->addMessage('required', _MD_PLAYERMAP_ERROR_REQUIRED, _MD_PLAYERMAP_LANG_TITLE);
		$this->mFieldProperties['title']->addMessage('maxlength', _MD_PLAYERMAP_ERROR_MAXLENGTH, _MD_PLAYERMAP_LANG_TITLE, '255');
		$this->mFieldProperties['title']->addVar('maxlength', '255');
		$this->mFieldProperties['uid'] = new XCube_FieldProperty($this);
		$this->mFieldProperties['group_id'] = new XCube_FieldProperty($this);
$this->mFieldProperties['group_id']->setDependsByArray(array('required'));
$this->mFieldProperties['group_id']->addMessage('required', _MD_PLAYERMAP_ERROR_REQUIRED, _MD_PLAYERMAP_LANG_GROUP_ID);
		$this->mFieldProperties['endtime'] = new XCube_FieldProperty($this);		$this->mFieldProperties['description'] = new XCube_FieldProperty($this);
		$this->mFieldProperties['description']->setDependsByArray(array('required'));
		$this->mFieldProperties['description']->addMessage('required', _MD_PLAYERMAP_ERROR_REQUIRED, _MD_PLAYERMAP_LANG_DESCRIPTION);
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
		$this->set('recruit_id', $obj->get('recruit_id'));
		$this->set('title', $obj->get('title'));
		$this->set('uid', $obj->get('uid'));
		$this->set('group_id', $obj->get('group_id'));
		$this->set('endtime', date(_PHPDATEPICKSTRING, $obj->get('endtime')));
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
		$obj->set('group_id', $this->get('group_id'));
		$obj->set('endtime', $this->_makeUnixtime('endtime'));
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
