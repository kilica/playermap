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

require_once PLAYERMAP_TRUST_PATH . '/actions/ReviewEditAction.class.php';

/**
 * Playermap_ReviewRaterAction
**/
class Playermap_ReviewRaterAction extends Playermap_ReviewEditAction
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
	
		//in this action, _getId means get book_id
		$uid = Legacy_Utils::getUid();
		$cri = new CriteriaCompo();
		$cri->add(new Criteria('book_id', $this->_getTargetId()));
		$cri->add(new Criteria('uid', $uid));
		$objs = $this->mObjectHandler->getObjects($cri);
		$this->mObject = (count($objs)>0) ? array_shift($objs) : $this->mObjectHandler->create();
		if($this->mObject->isNew()){
			$this->mObject->set('uid', $uid);
			$this->mObject->set('book_id', $this->_getTargetId());
		}
		$this->mObject->set('rating', $this->mRoot->mContext->mRequest->getRequest('rating'));
	
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
