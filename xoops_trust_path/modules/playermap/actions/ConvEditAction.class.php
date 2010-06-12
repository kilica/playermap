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
 * Playermap_ConvEditAction
**/
class Playermap_ConvEditAction extends Playermap_AbstractEditAction
{
	protected $_mScriptArr = array('datePicker', 'map');

	/**
	 * &_getHandler
	 * 
	 * @param	void
	 * 
	 * @return	Playermap_ConvHandler
	**/
	protected function &_getHandler()
	{
		$handler =& $this->mAsset->getObject('handler', 'Conv');
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
		$this->mActionForm =& $this->mAsset->getObject('form', 'Conv',false,'edit');
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
		}
		$this->mObject->loadPlayer();
		if($this->mObject->isNew()){
			$this->mObject->set('pref_id', $this->mObject->mPlayer->get('pref_id'));
		}

		$this->mCategoryManager['pref_id'] = new Playermap_CategoryManager($this->mAsset->mDirname, 'pref_id');
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
		$render->setTemplateName($this->mAsset->mDirname . '_conv_edit.html');
		$render->setAttribute('actionForm', $this->mActionForm);
		$render->setAttribute('object', $this->mObject);
		$render->setAttribute('Pref_idTree',$this->mCategoryManager['pref_id']->getTree(Playermap_CategoryManager::VIEW));
		$myGroupIds = Legacy_Utils::getModuleHandler('member', $this->mAsset->mDirname)->getMyGroupIdList();
		$render->setAttribute('myGroups', Legacy_Utils::getModuleHandler('group', $this->mAsset->mDirname)->getGroupListByIds($myGroupIds));
	}

	/**
	 * _doExecute
	 * 
	 * @param	void
	 * 
	 * @return	Enum
	**/
	protected function _doExecute()
	{
		if(! parent::_doExecute()){
			return PLAYERMAP_FRAME_VIEW_ERROR;
		}
	
		$ret = $this->_saveImage('conv', $this->mObject->get('title'), 'image1');
		return ($ret==true) ? PLAYERMAP_FRAME_VIEW_SUCCESS : PLAYERMAP_FRAME_VIEW_ERROR;
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
		$this->mRoot->mController->executeForward($this->_getNextUri('conv'));
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
		$this->mRoot->mController->executeRedirect($this->_getNextUri('conv'), 1, _MD_PLAYERMAP_ERROR_DBUPDATE_FAILED);
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
		$this->mRoot->mController->executeForward($this->_getNextUri('conv'));
	}
}

?>
