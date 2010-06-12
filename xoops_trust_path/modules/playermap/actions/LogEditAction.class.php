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
 * Playermap_LogEditAction
**/
class Playermap_LogEditAction extends Playermap_AbstractEditAction
{
	protected $_mScriptArr = array('datePicker', 'incSearch', 'rpgSelect');
	public $mDataname = 'rpg';

	/**
	 * _getRpgId
	 * 
	 * @param	void
	 * 
	 * @return	int
	**/
	protected function _getRpgId()
	{
		return $this->mRoot->mContext->mRequest->getRequest('rpg_id');
	}

	/**
	 * &_getHandler
	 * 
	 * @param	void
	 * 
	 * @return	Playermap_LogHandler
	**/
	protected function &_getHandler()
	{
		$handler =& $this->mAsset->getObject('handler', 'Log');
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
		$this->mActionForm =& $this->mAsset->getObject('form', 'Log',false,'edit');
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
				$this->mObject->set('rpg_id', $this->_getRpgId());
			}
		}
		$this->mObject->loadRpg();
		$this->mObject->loadPlayer();
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
		$render->setTemplateName($this->mAsset->mDirname . '_log_edit.html');
		$render->setAttribute('actionForm', $this->mActionForm);
		$render->setAttribute('object', $this->mObject);
		$render->setAttribute('myRpgs', Playermap_Utils::getMyRpg());
	
		$myGroupIds = Legacy_Utils::getModuleHandler('member', $this->mAsset->mDirname)->getMyGroupIdList();
		$render->setAttribute('myGroups', Legacy_Utils::getModuleHandler('group', $this->mAsset->mDirname)->getGroupListByIds($myGroupIds));
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
		if($this->mObject->isNew()){
			$this->mRoot->mController->executeForward(Legacy_Utils::renderUri($this->mAsset->mDirname, 'entry', 0, 'edit','log_id='.$this->mObject->get('log_id')));
		}
		else{
			$this->mRoot->mController->executeForward($this->_getNextUri('log'));
		}
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
		$this->mRoot->mController->executeRedirect($this->_getNextUri('log'), 1, _MD_PLAYERMAP_ERROR_DBUPDATE_FAILED);
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
		$this->mRoot->mController->executeForward($this->_getNextUri('log'));
	}
}

?>
