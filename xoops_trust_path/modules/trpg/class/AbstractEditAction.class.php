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

/**
 * Trpg_AbstractEditAction
**/
abstract class Trpg_AbstractEditAction extends Trpg_AbstractAction
{
	public /*** XoopsSimpleObject ***/ $mObject = null;

	public /*** XoopsObjectGenericHandler ***/ $mObjectHandler = null;

	public /*** XCube_ActionForm ***/ $mActionForm = null;

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
		return isset($dataId) ? intval($dataId) : intval($req->getRequest($this->_getHandler()->mPrimary));
	}

	/**
	 * &_getHandler
	 * 
	 * @param	void
	 * 
	 * @return	XoopsObjectGenericHandler
	**/
	protected function &_getHandler()
	{
	}

	/**
	 * _getActionName
	 * 
	 * @param	void
	 * 
	 * @return	string
	**/
	protected function _getActionName()
	{
		return _EDIT;
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
	}

	/**
	 * _setupObject
	 * 
	 * @param	void
	 * 
	 * @return	void
	**/
	protected function _setupObject()
	{
		$id = $this->_getId();
	
		$this->mObjectHandler =& $this->_getHandler();
	
		$this->mObject =& $this->mObjectHandler->get($id);
	
		if($this->mObject == null && $this->_isEnableCreate())
		{
			$this->mObject =& $this->mObjectHandler->create();
		}
	}

	/**
	 * _isEnableCreate
	 * 
	 * @param	void
	 * 
	 * @return	bool
	**/
	protected function _isEnableCreate()
	{
		return true;
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
		$this->_setupObject();
		$this->_setupActionForm();
	
		return true;
	}

	/**
	 * getDefaultView
	 * 
	 * @param	void
	 * 
	 * @return	Enum
	**/
	public function getDefaultView()
	{
		if($this->mObject == null)
		{
			return TRPG_FRAME_VIEW_ERROR;
		}
	
		$this->mActionForm->load($this->mObject);
	
		return TRPG_FRAME_VIEW_INPUT;
	}

	/**
	 * execute
	 * 
	 * @param	void
	 * 
	 * @return	Enum
	**/
	public function execute()
	{
		if ($this->mObject == null)
		{
			return TRPG_FRAME_VIEW_ERROR;
		}
	
		if ($this->mRoot->mContext->mRequest->getRequest('_form_control_cancel') != null)
		{
			return TRPG_FRAME_VIEW_CANCEL;
		}
	
		$this->mActionForm->load($this->mObject);
	
		$this->mActionForm->fetch();
		$this->mActionForm->validate();
	
		if ($this->mActionForm->hasError())
		{
			return TRPG_FRAME_VIEW_INPUT;
		}
	
		$this->mActionForm->update($this->mObject);
	
		return $this->_doExecute();
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
		if($this->mObjectHandler->insert($this->mObject))
		{
			return TRPG_FRAME_VIEW_SUCCESS;
		}
	
		return TRPG_FRAME_VIEW_ERROR;
	}


	/**
	 * _saveImage
	 * 
	 * @param	void
	 * 
	 * @return	Enum
	**/
	protected function _saveImage($dataname, $title, $formName, $num=1)
	{
		$primaryKey = $this->_getHandler()->mPrimary;
		$imageObjs = array();
		XCube_DelegateUtils::call('Legacy_ImageManager.GetImageObjects', new XCube_Ref($imageObjs), $this->mAsset->mDirname, $dataname, $this->mObject->get($primaryKey));
		if(count($imageObjs)>0){
			$image = array_shift($imageObjs);
		}
		else{
			$image = null;
			XCube_DelegateUtils::call('Legacy_ImageManager.CreateImageObject', new XCube_Ref($image));
			$image->set('title', $title);
			$image->set('uid', Legacy_Utils::getUid());
			$image->set('dirname', $this->mAsset->mDirname);
			$image->set('dataname', $dataname);
			$image->set('data_id', $this->mObject->get($primaryKey));
			$image->set('num', $num);
		}
	
		$ret = false;
		XCube_DelegateUtils::call('Legacy_ImageManager.SaveImage', new XCube_Ref($ret), $_FILES[$formName], $image);
	
		return $ret;
	}
}

?>
