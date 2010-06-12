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
 * Rpglink_LinkEditForm
**/
class Rpglink_LinkEditForm extends XCube_ActionForm
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
		return "module.rpglink.LinkEditForm.TOKEN";
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
		$this->mFormProperties['link_id'] = new XCube_IntProperty('link_id');
		$this->mFormProperties['title'] = new XCube_StringProperty('title');
		$this->mFormProperties['uid'] = new XCube_IntProperty('uid');
		$this->mFormProperties['url'] = new XCube_StringProperty('url');
		$this->mFormProperties['banner'] = new XCube_StringProperty('banner');
		$this->mFormProperties['rss'] = new XCube_StringProperty('rss');
		$this->mFormProperties['pref_id'] = new XCube_IntProperty('pref_id');
		$this->mFormProperties['description'] = new XCube_TextProperty('description');
		$this->mFormProperties['posttime'] = new XCube_IntProperty('posttime');

	
		//
		// Set field properties
		//
		$this->mFieldProperties['link_id'] = new XCube_FieldProperty($this);
$this->mFieldProperties['link_id']->setDependsByArray(array('required'));
$this->mFieldProperties['link_id']->addMessage('required', _MD_RPGLINK_ERROR_REQUIRED, _MD_RPGLINK_LANG_LINK_ID);
		$this->mFieldProperties['title'] = new XCube_FieldProperty($this);
		$this->mFieldProperties['title']->setDependsByArray(array('required','maxlength'));
		$this->mFieldProperties['title']->addMessage('required', _MD_RPGLINK_ERROR_REQUIRED, _MD_RPGLINK_LANG_TITLE);
		$this->mFieldProperties['title']->addMessage('maxlength', _MD_RPGLINK_ERROR_MAXLENGTH, _MD_RPGLINK_LANG_TITLE, '255');
		$this->mFieldProperties['title']->addVar('maxlength', '255');
		$this->mFieldProperties['uid'] = new XCube_FieldProperty($this);
		$this->mFieldProperties['url'] = new XCube_FieldProperty($this);
		$this->mFieldProperties['url']->setDependsByArray(array('required','maxlength'));
		$this->mFieldProperties['url']->addMessage('required', _MD_RPGLINK_ERROR_REQUIRED, _MD_RPGLINK_LANG_URL);
		$this->mFieldProperties['url']->addMessage('maxlength', _MD_RPGLINK_ERROR_MAXLENGTH, _MD_RPGLINK_LANG_URL, '255');
		$this->mFieldProperties['url']->addVar('maxlength', '255');
		$this->mFieldProperties['banner'] = new XCube_FieldProperty($this);
		$this->mFieldProperties['rss'] = new XCube_FieldProperty($this);
		$this->mFieldProperties['pref_id'] = new XCube_FieldProperty($this);
		$this->mFieldProperties['pref_id']->setDependsByArray(array('required'));
		$this->mFieldProperties['pref_id']->addMessage('required', _MD_RPGLINK_ERROR_REQUIRED, _MD_RPGLINK_LANG_PREF_ID);
		$this->mFieldProperties['description'] = new XCube_FieldProperty($this);		$this->mFieldProperties['posttime'] = new XCube_FieldProperty($this);
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
		$this->set('link_id', $obj->get('link_id'));
		$this->set('title', $obj->get('title'));
		$this->set('uid', $obj->get('uid'));
		$this->set('url', $obj->get('url'));
		$this->set('banner', $obj->get('banner'));
		$this->set('rss', $obj->get('rss'));
		$this->set('pref_id', $obj->get('pref_id'));
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
		$obj->set('url', $this->get('url'));
		$obj->set('banner', $this->get('banner'));
		$obj->set('rss', $this->get('rss'));
		$obj->set('pref_id', $this->get('pref_id'));
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
