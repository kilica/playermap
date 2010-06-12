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

require_once RPGLINK_TRUST_PATH . '/class/AbstractViewAction.class.php';

/**
 * Rpglink_UpdateViewAction
**/
class Rpglink_UpdateViewAction extends Rpglink_AbstractViewAction
{
	/**
	 * &_getHandler
	 * 
	 * @param	void
	 * 
	 * @return	Rpglink_UpdateHandler
	**/
	protected function &_getHandler()
	{
		$handler =& $this->mAsset->getObject('handler', 'Update');
		return $handler;
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
		$this->mObject->loadLink();
	
		return true;
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
		$render->setTemplateName($this->mAsset->mDirname . '_update_view.html');
		$render->setAttribute('object', $this->mObject);
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
		$this->mRoot->mController->executeRedirect($this->_getNextUri('update', 'list'), 1, _MD_RPGLINK_ERROR_CONTENT_IS_NOT_FOUND);
	}
}

?>
