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

require_once PLAYERMAP_TRUST_PATH . '/actions/ConneEditAction.class.php';

/**
 * Playermap_ConneLikeAction
**/
class Playermap_ConneLikeAction extends Playermap_ConneEditAction
{
	/**
	 * _getTargetId()
	 * 
	 * @param	void
	 * 
	 * @return	bool
	**/
	protected function _getTargetId()
	{
		$idArr = explode('-', $this->mRoot->mContext->mRequest->getRequest('target_id'));
		return $idArr[1];
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
		$this->mObjectHandler =& $this->_getHandler();
	
		//in this action, _getId means get rpg_id
		$uid = Legacy_Utils::getUid();
		$cri = new CriteriaCompo();
		$cri->add(new Criteria('conne_uid', $this->_getTargetId()));
		$cri->add(new Criteria('uid', $uid));
		$objs = $this->mObjectHandler->getObjects($cri);
		$this->mObject = (count($objs)>0) ? array_shift($objs) : $this->mObjectHandler->create();
		if($this->mObject->isNew()){
			$this->mObject->set('uid', $uid);
			$this->mObject->set('conne_uid', $this->_getTargetId());
		}
	
		return true;
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
			return PLAYERMAP_FRAME_VIEW_ERROR;
		}
	
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
		if($this->mObject->isNew()){	//insert
			if($this->mObjectHandler->insert($this->mObject))
			{
				return PLAYERMAP_FRAME_VIEW_SUCCESS;
			}
		}
		else{	//delete
			if($this->mObjectHandler->delete($this->mObject))
			{
				return PLAYERMAP_FRAME_VIEW_SUCCESS;
			}
		}
	
		return PLAYERMAP_FRAME_VIEW_ERROR;
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
		exit();
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
		exit();
	}
}

?>
