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

require_once PLAYERMAP_TRUST_PATH . '/class/AbstractEditAction.class.php';

/**
 * Playermap_EntryEditAction
**/
class Playermap_EntryEditAction extends Playermap_AbstractEditAction
{
	/**
	 * _getLogId
	 * 
	 * @param	void
	 * 
	 * @return	int
	**/
	protected function _getLogId()
	{
		return $this->mRoot->mContext->mRequest->getRequest('log_id');
	}

	/**
	 * &_getHandler
	 * 
	 * @param	void
	 * 
	 * @return	Playermap_EntryHandler
	**/
	protected function &_getHandler()
	{
		$handler =& $this->mAsset->getObject('handler', 'Entry');
		return $handler;
	}

	/**
	 * _setupActionForm
	 * 
	 * @param	void
	 * 
	 * @return	void
	**/
	protected function _setupActionForm()
	{
		$this->mActionForm =& $this->mAsset->getObject('form', 'Entry',false,'edit');
		$this->mActionForm->prepare();
	}

	/**
	 * prepare
	 * 
	 * @param	void
	 * 
	 * @return	bool
	**/
	public function prepare()
	{
		parent::prepare();
		if($this->mObject->isNew()){
			if($this->mRoot->mContext->mUser->isInRole('Site.RegisteredUser')){
				$this->mObject->set('uid', $this->mRoot->mContext->mXoopsUser->get('uid'));
			}
			$this->mObject->set('log_id', $this->_getLogId());
		}
		$this->mObject->loadPlayer();
		$this->mObject->loadLog();
		if($this->mObject->mLog->get('sessiontime')<86400 && $this->mObject->mLog->get('scheduletime')<86400 ){
			$this->mObject->set('scheduletime', time());
		}
		$this->mObject->mLog->loadEntry();
		foreach(array_keys($this->mObject->mLog->mEntry) as $key){
			$this->mObject->mLog->mEntry[$key]->loadSchedule();
		}
		$this->mObject->loadSchedule();
	
		return true;
	}

	/**
	 * executeViewInput
	 * 
	 * @param	XCube_RenderTarget	&$render
	 * 
	 * @return	void
	**/
	public function executeViewInput(/*** XCube_RenderTarget ***/ &$render)
	{
		if($this->mObject->mLog->get('scheduletime')>86400){
			$render->setTemplateName($this->mAsset->mDirname . '_entry_schedule.html');
		}
		else{
			$render->setTemplateName($this->mAsset->mDirname . '_entry_edit.html');
		}
		$render->setAttribute('actionForm', $this->mActionForm);
		$render->setAttribute('object', $this->mObject);
		$render->setAttribute('calendar', $this->mObject->mLog->createHostCalendar());
	}

	/**
	 * executeViewSuccess
	 * 
	 * @param	XCube_RenderTarget	&$render
	 * 
	 * @return	void
	**/
	public function executeViewSuccess(/*** XCube_RenderTarget ***/ &$render)
	{
		$this->mRoot->mController->executeForward(Legacy_Utils::renderUri($this->mAsset->mDirname, 'log', $this->mObject->get('log_id')));
	}

	/**
	 * executeViewError
	 * 
	 * @param	XCube_RenderTarget	&$render
	 * 
	 * @return	void
	**/
	public function executeViewError(/*** XCube_RenderTarget ***/ &$render)
	{
		$this->mRoot->mController->executeRedirect($this->_getNextUri('entry'), 1, _MD_PLAYERMAP_ERROR_DBUPDATE_FAILED);
	}

	/**
	 * executeViewCancel
	 * 
	 * @param	XCube_RenderTarget	&$render
	 * 
	 * @return	void
	**/
	public function executeViewCancel(/*** XCube_RenderTarget ***/ &$render)
	{
		$this->mRoot->mController->executeForward($this->_getNextUri('entry'));
	}
}

?>
