<?php
/**
 * @file
 * @package trpg
 * @version $Id$
**/

if(!defined('XOOPS_ROOT_PATH'))
{
	exit;
}

require_once XOOPS_ROOT_PATH . '/core/XCube_ActionForm.class.php';
require_once XOOPS_MODULE_PATH . '/legacy/class/Legacy_Validator.class.php';

/**
 * Trpg_RpgEditForm
**/
class Trpg_RpgEditForm extends XCube_ActionForm
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
		return "module.trpg.RpgEditForm.TOKEN";
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
		$this->mFormProperties['rpg_id'] = new XCube_IntProperty('rpg_id');
		$this->mFormProperties['title'] = new XCube_StringProperty('title');
		$this->mFormProperties['kana'] = new XCube_StringProperty('kana');
		$this->mFormProperties['abbr'] = new XCube_StringProperty('abbr');
		$this->mFormProperties['pub_id'] = new XCube_IntProperty('pub_id');
		$this->mFormProperties['url'] = new XCube_StringProperty('url');
		$this->mFormProperties['description'] = new XCube_TextProperty('description');
		$this->mFormProperties['posttime'] = new XCube_IntProperty('posttime');

	
		//
		// Set field properties
		//
		$this->mFieldProperties['rpg_id'] = new XCube_FieldProperty($this);
$this->mFieldProperties['rpg_id']->setDependsByArray(array('required'));
$this->mFieldProperties['rpg_id']->addMessage('required', _MD_TRPG_ERROR_REQUIRED, _MD_TRPG_LANG_RPG_ID);
		$this->mFieldProperties['title'] = new XCube_FieldProperty($this);
		$this->mFieldProperties['title']->setDependsByArray(array('required','maxlength'));
		$this->mFieldProperties['title']->addMessage('required', _MD_TRPG_ERROR_REQUIRED, _MD_TRPG_LANG_TITLE);
		$this->mFieldProperties['title']->addMessage('maxlength', _MD_TRPG_ERROR_MAXLENGTH, _MD_TRPG_LANG_TITLE, '255');
		$this->mFieldProperties['title']->addVar('maxlength', '255');
		$this->mFieldProperties['kana'] = new XCube_FieldProperty($this);
		$this->mFieldProperties['kana']->setDependsByArray(array('required','maxlength'));
		$this->mFieldProperties['kana']->addMessage('required', _MD_TRPG_ERROR_REQUIRED, _MD_TRPG_LANG_KANA);
		$this->mFieldProperties['kana']->addMessage('maxlength', _MD_TRPG_ERROR_MAXLENGTH, _MD_TRPG_LANG_KANA, '128');
		$this->mFieldProperties['kana']->addVar('maxlength', '128');
		$this->mFieldProperties['abbr'] = new XCube_FieldProperty($this);
		$this->mFieldProperties['abbr']->setDependsByArray(array('required','maxlength'));
		$this->mFieldProperties['abbr']->addMessage('required', _MD_TRPG_ERROR_REQUIRED, _MD_TRPG_LANG_ABBR);
		$this->mFieldProperties['abbr']->addMessage('maxlength', _MD_TRPG_ERROR_MAXLENGTH, _MD_TRPG_LANG_ABBR, '60');
		$this->mFieldProperties['abbr']->addVar('maxlength', '60');
		$this->mFieldProperties['pub_id'] = new XCube_FieldProperty($this);
$this->mFieldProperties['pub_id']->setDependsByArray(array('required'));
$this->mFieldProperties['pub_id']->addMessage('required', _MD_TRPG_ERROR_REQUIRED, _MD_TRPG_LANG_PUB_ID);
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
		$this->set('rpg_id', $obj->get('rpg_id'));
		$this->set('title', $obj->get('title'));
		$this->set('kana', $obj->get('kana'));
		$this->set('abbr', $obj->get('abbr'));
		$this->set('pub_id', $obj->get('pub_id'));
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
		$obj->set('kana', $this->get('kana'));
		$obj->set('abbr', $this->get('abbr'));
		$obj->set('pub_id', $this->get('pub_id'));
		$obj->set('url', $this->get('url'));
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
