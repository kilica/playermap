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
 * Playermap_ConvEditForm
**/
class Playermap_ConvEditForm extends XCube_ActionForm
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
		return "module.playermap.ConvEditForm.TOKEN";
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
		$this->mFormProperties['conv_id'] = new XCube_IntProperty('conv_id');
		$this->mFormProperties['title'] = new XCube_StringProperty('title');
		$this->mFormProperties['uid'] = new XCube_IntProperty('uid');
		$this->mFormProperties['group_id'] = new XCube_IntProperty('group_id');
		$this->mFormProperties['pref_id'] = new XCube_IntProperty('pref_id');
		$this->mFormProperties['site'] = new XCube_StringProperty('site');
		$this->mFormProperties['address'] = new XCube_TextProperty('address');
		$this->mFormProperties['cv_lat'] = new XCube_FloatProperty('cv_lat');
		$this->mFormProperties['cv_lng'] = new XCube_FloatProperty('cv_lng');
		$this->mFormProperties['starttime'] = new XCube_StringProperty('starttime');
		$this->mFormProperties['endtime'] = new XCube_StringProperty('endtime');
		$this->mFormProperties['booking'] = new XCube_IntProperty('booking');
		$this->mFormProperties['fee'] = new XCube_TextProperty('fee');
		$this->mFormProperties['capacity'] = new XCube_IntProperty('capacity');
		$this->mFormProperties['url'] = new XCube_StringProperty('url');
		$this->mFormProperties['description'] = new XCube_TextProperty('description');
		$this->mFormProperties['posttime'] = new XCube_IntProperty('posttime');

	
		//
		// Set field properties
		//
		$this->mFieldProperties['conv_id'] = new XCube_FieldProperty($this);
$this->mFieldProperties['conv_id']->setDependsByArray(array('required'));
$this->mFieldProperties['conv_id']->addMessage('required', _MD_PLAYERMAP_ERROR_REQUIRED, _MD_PLAYERMAP_LANG_CONV_ID);
		$this->mFieldProperties['title'] = new XCube_FieldProperty($this);
		$this->mFieldProperties['title']->setDependsByArray(array('required','maxlength'));
		$this->mFieldProperties['title']->addMessage('required', _MD_PLAYERMAP_ERROR_REQUIRED, _MD_PLAYERMAP_LANG_TITLE);
		$this->mFieldProperties['title']->addMessage('maxlength', _MD_PLAYERMAP_ERROR_MAXLENGTH, _MD_PLAYERMAP_LANG_TITLE, '255');
		$this->mFieldProperties['title']->addVar('maxlength', '255');
		$this->mFieldProperties['uid'] = new XCube_FieldProperty($this);
		$this->mFieldProperties['group_id'] = new XCube_FieldProperty($this);
		$this->mFieldProperties['pref_id'] = new XCube_FieldProperty($this);
		$this->mFieldProperties['pref_id']->setDependsByArray(array('required'));
		$this->mFieldProperties['pref_id']->addMessage('required', _MD_PLAYERMAP_ERROR_REQUIRED, _MD_PLAYERMAP_LANG_PREF_ID);
		$this->mFieldProperties['site'] = new XCube_FieldProperty($this);
		$this->mFieldProperties['address'] = new XCube_FieldProperty($this);
		$this->mFieldProperties['starttime'] = new XCube_FieldProperty($this);			$this->mFieldProperties['endtime'] = new XCube_FieldProperty($this);			$this->mFieldProperties['booking'] = new XCube_FieldProperty($this);
		$this->mFieldProperties['fee'] = new XCube_FieldProperty($this);
		$this->mFieldProperties['capacity'] = new XCube_FieldProperty($this);
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
		$this->set('conv_id', $obj->get('conv_id'));
		$this->set('title', $obj->get('title'));
		$this->set('uid', $obj->get('uid'));
		$this->set('group_id', $obj->get('group_id'));
		$this->set('pref_id', $obj->get('pref_id'));
		$this->set('site', $obj->get('site'));
		$this->set('address', $obj->get('address'));
		$this->set('cv_lat', $obj->get('cv_lat'));
		$this->set('cv_lng', $obj->get('cv_lng'));
		$this->set('starttime', date(_PHPDATEPICKSTRING, $obj->get('starttime')));
		$this->set('endtime', date(_PHPDATEPICKSTRING, $obj->get('endtime')));
		$this->set('booking', $obj->get('booking'));
		$this->set('fee', $obj->get('fee'));
		$this->set('capacity', $obj->get('capacity'));
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
		$obj->set('group_id', $this->get('group_id'));
		$obj->set('pref_id', $this->get('pref_id'));
		$obj->set('site', $this->get('site'));
		$obj->set('address', $this->get('address'));
		$obj->set('cv_lat', $this->get('cv_lat'));
		$obj->set('cv_lng', $this->get('cv_lng'));
		$obj->set('starttime', $this->_makeUnixtime('starttime'));
		$obj->set('endtime', $this->_makeUnixtime('endtime'));
		$obj->set('booking', $this->get('booking'));
		$obj->set('fee', $this->get('fee'));
		$obj->set('capacity', $this->get('capacity'));
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
