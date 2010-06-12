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
 * Trpg_BookEditForm
**/
class Trpg_BookEditForm extends XCube_ActionForm
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
		return "module.trpg.BookEditForm.TOKEN";
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
		$this->mFormProperties['book_id'] = new XCube_IntProperty('book_id');
		$this->mFormProperties['title'] = new XCube_StringProperty('title');
		$this->mFormProperties['rpg_id'] = new XCube_IntProperty('rpg_id');
		$this->mFormProperties['version'] = new XCube_StringProperty('version');
		$this->mFormProperties['btype'] = new XCube_IntProperty('btype');
		$this->mFormProperties['pub_id'] = new XCube_IntProperty('pub_id');
		$this->mFormProperties['isbn'] = new XCube_StringProperty('isbn');
		$this->mFormProperties['isbn13'] = new XCube_StringProperty('isbn13');
		$this->mFormProperties['pubyear'] = new XCube_IntProperty('pubyear');
		$this->mFormProperties['price'] = new XCube_FloatProperty('price');
		$this->mFormProperties['currency'] = new XCube_IntProperty('currency');
		$this->mFormProperties['url'] = new XCube_StringProperty('url');
		$this->mFormProperties['description'] = new XCube_TextProperty('description');
		$this->mFormProperties['posttime'] = new XCube_IntProperty('posttime');

	
		//
		// Set field properties
		//
		$this->mFieldProperties['book_id'] = new XCube_FieldProperty($this);
$this->mFieldProperties['book_id']->setDependsByArray(array('required'));
$this->mFieldProperties['book_id']->addMessage('required', _MD_TRPG_ERROR_REQUIRED, _MD_TRPG_LANG_BOOK_ID);
		$this->mFieldProperties['title'] = new XCube_FieldProperty($this);
		$this->mFieldProperties['title']->setDependsByArray(array('required','maxlength'));
		$this->mFieldProperties['title']->addMessage('required', _MD_TRPG_ERROR_REQUIRED, _MD_TRPG_LANG_TITLE);
		$this->mFieldProperties['title']->addMessage('maxlength', _MD_TRPG_ERROR_MAXLENGTH, _MD_TRPG_LANG_TITLE, '255');
		$this->mFieldProperties['title']->addVar('maxlength', '255');
		$this->mFieldProperties['rpg_id'] = new XCube_FieldProperty($this);
		$this->mFieldProperties['rpg_id']->setDependsByArray(array('required'));
		$this->mFieldProperties['rpg_id']->addMessage('required', _MD_TRPG_ERROR_REQUIRED, _MD_TRPG_LANG_RPG_ID);
		$this->mFieldProperties['version'] = new XCube_FieldProperty($this);
		$this->mFieldProperties['btype'] = new XCube_FieldProperty($this);
$this->mFieldProperties['btype']->setDependsByArray(array('required'));
$this->mFieldProperties['btype']->addMessage('required', _MD_TRPG_ERROR_REQUIRED, _MD_TRPG_LANG_BTYPE);
		$this->mFieldProperties['pub_id'] = new XCube_FieldProperty($this);
		$this->mFieldProperties['pub_id']->setDependsByArray(array('required'));
		$this->mFieldProperties['pub_id']->addMessage('required', _MD_TRPG_ERROR_REQUIRED, _MD_TRPG_LANG_PUB_ID);
		$this->mFieldProperties['isbn'] = new XCube_FieldProperty($this);
		$this->mFieldProperties['isbn']->setDependsByArray(array('maxlength'));
		$this->mFieldProperties['isbn']->addMessage('maxlength', _MD_TRPG_ERROR_MAXLENGTH, _MD_TRPG_LANG_ISBN, '10');
		$this->mFieldProperties['isbn']->addVar('maxlength', '10');
		$this->mFieldProperties['isbn13'] = new XCube_FieldProperty($this);
		$this->mFieldProperties['isbn13']->setDependsByArray(array('maxlength'));
		$this->mFieldProperties['isbn13']->addMessage('maxlength', _MD_TRPG_ERROR_MAXLENGTH, _MD_TRPG_LANG_ISBN13, '13');
		$this->mFieldProperties['isbn13']->addVar('maxlength', '13');
		$this->mFieldProperties['pubyear'] = new XCube_FieldProperty($this);
		$this->mFieldProperties['price'] = new XCube_FieldProperty($this);
		$this->mFieldProperties['currency'] = new XCube_FieldProperty($this);
		$this->mFieldProperties['currency']->setDependsByArray(array('required'));
$this->mFieldProperties['currency']->addMessage('required', _MD_TRPG_ERROR_REQUIRED, _MD_TRPG_LANG_CURRENCY);
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
		$this->set('book_id', $obj->get('book_id'));
		$this->set('title', $obj->get('title'));
		$this->set('rpg_id', $obj->get('rpg_id'));
		$this->set('version', $obj->get('version'));
		$this->set('btype', $obj->get('btype'));
		$this->set('pub_id', $obj->get('pub_id'));
		$this->set('isbn', $obj->get('isbn'));
		$this->set('isbn13', $obj->get('isbn13'));
		$this->set('pubyear', $obj->get('pubyear'));
		$this->set('price', $obj->get('price'));
		$this->set('currency', $obj->get('currency'));
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
		$obj->set('version', $this->get('version'));
		$obj->set('btype', $this->get('btype'));
		$obj->set('pub_id', $this->get('pub_id'));
		$obj->set('isbn', $this->get('isbn'));
		$obj->set('isbn13', $this->get('isbn13'));
		$obj->set('pubyear', $this->get('pubyear'));
		$obj->set('price', $this->get('price'));
		$obj->set('currency', $this->get('currency'));
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
