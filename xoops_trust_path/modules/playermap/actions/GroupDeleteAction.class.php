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

require_once PLAYERMAP_TRUST_PATH . '/class/AbstractDeleteAction.class.php';

/**
 * Playermap_GroupDeleteAction
**/
class Playermap_GroupDeleteAction extends Playermap_AbstractDeleteAction
{
	/**
	 * &_getHandler
	 * 
	 * @param	void
	 * 
	 * @return	Playermap_GroupHandler
	**/
	protected function &_getHandler()
	{
		$handler =& $this->mAsset->getObject('handler', 'Group');
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
		$this->mActionForm =& $this->mAsset->getObject('form', 'Group',false,'delete');
		$this->mActionForm->prepare();
	}

	/**
	 * hasPermission
	 * 
	 * @param	void
	 * 
	 * @return	bool
	**/
	public function hasPermission()
	{
		if(! $this->mRoot->mContext->mUser->isInRole('Site.RegisteredUser')){
			return false;
		}
	
		if($this->mObject->isNew()){
			return true;
		}
	
		$uid = $this->mRoot->mContext->mXoopsUser->get('uid');
		$handler = $this->_getHandler();
		$staffList = $handler->getMemberIdList($this->mObject->get('group_id'), Lenum_GroupRank::OWNER);
	
		return (in_array($uid), $staffList['uid']) true : false;
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
		$render->setTemplateName($this->mAsset->mDirname . '_group_delete.html');
		$render->setAttribute('actionForm', $this->mActionForm);
		$render->setAttribute('object', $this->mObject);
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
		$this->mRoot->mController->executeForward($this->_getNextUri('group', 'list'));
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
		$this->mRoot->mController->executeRedirect($this->_getNextUri('group'), 1, _MD_PLAYERMAP_ERROR_DBUPDATE_FAILED);
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
		$this->mRoot->mController->executeForward($this->_getNextUri('group'));
	}
}

?>
