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
 * Playermap_EntryEditForm
**/
class Playermap_EntryEditForm extends XCube_ActionForm
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
		return "module.playermap.EntryEditForm.TOKEN";
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
		$this->mFormProperties['entry_id'] = new XCube_IntProperty('entry_id');
		$this->mFormProperties['log_id'] = new XCube_IntProperty('log_id');
		$this->mFormProperties['uid'] = new XCube_IntProperty('uid');
		$this->mFormProperties['role'] = new XCube_IntProperty('role');
		$this->mFormProperties['schedule'] = new XCube_TextProperty('schedule');
		$this->mFormProperties['description'] = new XCube_TextProperty('description');
		$this->mFormProperties['comment'] = new XCube_TextProperty('comment');
		$this->mFormProperties['posttime'] = new XCube_IntProperty('posttime');

	
		//
		// Set field properties
		//
		$this->mFieldProperties['entry_id'] = new XCube_FieldProperty($this);
		$this->mFieldProperties['entry_id']->setDependsByArray(array('required'));
		$this->mFieldProperties['entry_id']->addMessage('required', _MD_PLAYERMAP_ERROR_REQUIRED, _MD_PLAYERMAP_LANG_ENTRY_ID);
		$this->mFieldProperties['log_id'] = new XCube_FieldProperty($this);
		$this->mFieldProperties['log_id']->setDependsByArray(array('required'));
		$this->mFieldProperties['log_id']->addMessage('required', _MD_PLAYERMAP_ERROR_REQUIRED, _MD_PLAYERMAP_LANG_LOG_ID);
		$this->mFieldProperties['uid'] = new XCube_FieldProperty($this);
		$this->mFieldProperties['role'] = new XCube_FieldProperty($this);
		$this->mFieldProperties['role']->setDependsByArray(array('required'));
		$this->mFieldProperties['role']->addMessage('required', _MD_PLAYERMAP_ERROR_REQUIRED, _MD_PLAYERMAP_LANG_ROLE);
		$this->mFieldProperties['schedule'] = new XCube_FieldProperty($this);
		$this->mFieldProperties['description'] = new XCube_FieldProperty($this);
		$this->mFieldProperties['comment'] = new XCube_FieldProperty($this);
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
		$this->set('entry_id', $obj->get('entry_id'));
		$this->set('log_id', $obj->get('log_id'));
		$this->set('uid', $obj->get('uid'));
		$this->set('role', $obj->get('role'));
		$this->set('schedule', $obj->get('schedule'));
		$this->set('description', $obj->get('description'));
		$this->set('comment', $obj->get('comment'));
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
		$obj->set('log_id', $this->get('log_id'));
		$obj->set('role', $this->get('role'));
		$obj->set('schedule', $this->getSchedule());
		$obj->set('description', $textFilter = XCube_Root::getSingleton()->getTextFilter()->purifyHtml($this->get('description')));
;
		$obj->set('comment', $this->get('comment'));
	}

	public function getSchedule()
	{
		$root = XCube_Root::getSingleton();
		$sche = $root->mContext->mRequest->getRequest('sche');
		$sche = isset($sche) ? $sche : array();
		$handler = Legacy_Utils::getModuleHandler('log', PLAYERMAP_DIRNAME);
		$log = $handler->get($this->get('log_id'));
		array_push($sche, $log->get('scheduletime'));
		$schedule = implode(',',$sche);
		
		return $schedule;
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
