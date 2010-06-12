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
 * Playermap_ReviewEditForm
**/
class Playermap_ReviewEditForm extends XCube_ActionForm
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
		return "module.playermap.ReviewEditForm.TOKEN";
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
		$this->mFormProperties['review_id'] = new XCube_IntProperty('review_id');
		$this->mFormProperties['book_id'] = new XCube_IntProperty('book_id');
		$this->mFormProperties['uid'] = new XCube_IntProperty('uid');
		$this->mFormProperties['rating'] = new XCube_IntProperty('rating');
		$this->mFormProperties['importance'] = new XCube_IntProperty('importance');
		$this->mFormProperties['owner'] = new XCube_BoolProperty('owner');
		$this->mFormProperties['description'] = new XCube_TextProperty('description');
		$this->mFormProperties['posttime'] = new XCube_IntProperty('posttime');

	
		//
		// Set field properties
		//
		$this->mFieldProperties['review_id'] = new XCube_FieldProperty($this);
		$this->mFieldProperties['review_id']->setDependsByArray(array('required'));
		$this->mFieldProperties['review_id']->addMessage('required', _MD_PLAYERMAP_ERROR_REQUIRED, _MD_PLAYERMAP_LANG_REVIEW_ID);
		$this->mFieldProperties['book_id'] = new XCube_FieldProperty($this);
		$this->mFieldProperties['book_id']->setDependsByArray(array('required'));
		$this->mFieldProperties['book_id']->addMessage('required', _MD_PLAYERMAP_ERROR_REQUIRED, _MD_PLAYERMAP_LANG_BOOK_ID);
		$this->mFieldProperties['uid'] = new XCube_FieldProperty($this);
		$this->mFieldProperties['rating'] = new XCube_FieldProperty($this);
		$this->mFieldProperties['rating']->setDependsByArray(array('required'));
		$this->mFieldProperties['rating']->addMessage('required', _MD_PLAYERMAP_ERROR_REQUIRED, _MD_PLAYERMAP_LANG_RATING);
		$this->mFieldProperties['importance'] = new XCube_FieldProperty($this);
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
		$this->set('review_id', $obj->get('review_id'));
		$this->set('book_id', $obj->get('book_id'));
		$this->set('uid', $obj->get('uid'));
		$this->set('rating', $obj->get('rating'));
		$this->set('importance', $obj->get('importance'));
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
		$obj->set('book_id', $this->get('book_id'));
		$obj->set('rating', $this->get('rating'));
		$obj->set('importance', $this->get('importance'));
		$obj->set('owner', $this->get('owner'));
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
