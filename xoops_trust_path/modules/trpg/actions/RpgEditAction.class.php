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

require_once TRPG_TRUST_PATH . '/class/AbstractEditAction.class.php';

/**
 * Trpg_RpgEditAction
**/
class Trpg_RpgEditAction extends Trpg_AbstractEditAction
{
	/**
	 * &_getHandler
	 * 
	 * @param	void
	 * 
	 * @return	Trpg_RpgHandler
	**/
	protected function &_getHandler()
	{
		$handler =& $this->mAsset->getObject('handler', 'Rpg');
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
		$this->mActionForm =& $this->mAsset->getObject('form', 'Rpg',false,'edit');
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
		return $this->mRoot->mContext->mUser->isInRole('Site.Owner') ? true : false;
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
		$this->mCategoryManager['pub_id'] = new Trpg_CategoryManager($this->mAsset->mDirname, 'pub_id');
		return true;
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
			return TRPG_FRAME_VIEW_ERROR;
		}
	
		$ret = $this->_saveImage('rpg', $this->mObject->get('title'), 'image1');
		return ($ret==true) ? TRPG_FRAME_VIEW_SUCCESS : TRPG_FRAME_VIEW_ERROR;
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
		$render->setTemplateName($this->mAsset->mDirname . '_rpg_edit.html');
		$render->setAttribute('actionForm', $this->mActionForm);
		$render->setAttribute('object', $this->mObject);
		$render->setAttribute('image', $this->mObject->getImage());
		$render->setAttribute('dirname', $this->mAsset->mDirname);
		$render->setAttribute('Pub_idTree',$this->mCategoryManager['pub_id']->getTree(Trpg_CategoryManager::VIEW));
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
		$this->mRoot->mController->executeForward($this->_getNextUri('rpg'));
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
		$this->mRoot->mController->executeRedirect($this->_getNextUri('rpg'), 1, _MD_TRPG_ERROR_DBUPDATE_FAILED);
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
		$this->mRoot->mController->executeForward($this->_getNextUri('rpg'));
	}
}

?>
