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

require_once RPGLINK_TRUST_PATH . '/class/AbstractEditAction.class.php';

/**
 * Rpglink_LinkEditAction
**/
class Rpglink_LinkEditAction extends Rpglink_AbstractEditAction
{
	/**
	 * _getId
	 * 
	 * @param	void
	 * 
	 * @return	int
	**/
	protected function _getId()
	{
		$req = $this->mRoot->mContext->mRequest;
		$dataId = $req->getRequest(_REQUESTED_DATA_ID);
		$id = isset($dataId) ? intval($dataId) : intval($req->getRequest($this->_getHandler()->mPrimary));
		if(! isset($id)){
			$objs = $this->_getHandler()->getObjects(new Criteria('uid', Legacy_Utils::getUid()));
			if(count($objs)>0){
				return $objs[0]->get('link_id');
			}
		}
		return $id;
	}

	/**
	 * &_getHandler
	 * 
	 * @param	void
	 * 
	 * @return	Rpglink_LinkHandler
	**/
	protected function &_getHandler()
	{
		$handler =& $this->mAsset->getObject('handler', 'Link');
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
		$this->mActionForm =& $this->mAsset->getObject('form', 'Link',false,'edit');
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
		return $this->mRoot->mContext->mUser->isInRole('Site.RegisteredUser') ? true : false;
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
		$this->mCategoryManager['pref_id'] = new Rpglink_CategoryManager($this->mAsset->mDirname, 'pref_id');
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
			return RPGLINK_FRAME_VIEW_ERROR;
		}
	
		$ret = $this->_saveImage('link', $this->mObject->get('title'), 'image1');
		return ($ret==true) ? RPGLINK_FRAME_VIEW_SUCCESS : RPGLINK_FRAME_VIEW_ERROR;
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
		$render->setTemplateName($this->mAsset->mDirname . '_link_edit.html');
		$render->setAttribute('actionForm', $this->mActionForm);
		$render->setAttribute('object', $this->mObject);
		$render->setAttribute('object', $this->mObject->getImage());
		$render->setAttribute('dirname', $this->mAsset->mDirname);
		$render->setAttribute('Pref_idTree',$this->mCategoryManager['pref_id']->getTree(Rpglink_CategoryManager::VIEW));
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
		$this->mRoot->mController->executeForward($this->_getNextUri('link'));
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
		$this->mRoot->mController->executeRedirect($this->_getNextUri('link'), 1, _MD_RPGLINK_ERROR_DBUPDATE_FAILED);
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
		$this->mRoot->mController->executeForward($this->_getNextUri('link'));
	}
}

?>
