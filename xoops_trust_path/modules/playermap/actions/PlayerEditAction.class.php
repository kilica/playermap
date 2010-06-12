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
 * Playermap_PlayerEditAction
**/
class Playermap_PlayerEditAction extends Playermap_AbstractEditAction
{
	protected $_mScriptArr = array('map');

	/**
	 * _getId
	 * 
	 * @param	void
	 * 
	 * @return	int
	**/
	protected function _getId()
	{
		if($this->mRoot->mContext->mUser->isInRole('Site.RegisteredUser')){
			return $this->mRoot->mContext->mXoopsUser->get('uid');
		}
		else{
		$this->mRoot->mController->executeRedirect(XOOPS_URL.'/login.php');
		}
	}

	/**
	 * &_getHandler
	 * 
	 * @param	void
	 * 
	 * @return	Playermap_PlayerHandler
	**/
	protected function &_getHandler()
	{
		$handler =& $this->mAsset->getObject('handler', 'Player');
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
		$this->mActionForm =& $this->mAsset->getObject('form', 'Player',false,'edit');
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
		$render->setTemplateName($this->mAsset->mDirname . '_player_edit.html');
		$render->setAttribute('actionForm', $this->mActionForm);
		$render->setAttribute('object', $this->mObject);
		$render->setAttribute('Pref_idTree',$this->mCategoryManager['pref_id']->getTree(Playermap_CategoryManager::VIEW));
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
	
		$ret = $this->_saveImage('player', $this->mObject->get('name'), 'image1');
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
		$this->mRoot->mController->executeForward($this->_getNextUri('player'));
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
		$this->mRoot->mController->executeRedirect($this->_getNextUri('player'), 1, _MD_PLAYERMAP_ERROR_DBUPDATE_FAILED);
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
		$this->mRoot->mController->executeForward($this->_getNextUri('player'));
	}
}

?>
