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

require_once PLAYERMAP_TRUST_PATH . '/class/AbstractViewAction.class.php';

/**
 * Playermap_ConneViewAction
**/
class Playermap_ConneViewAction extends Playermap_AbstractViewAction
{
	/**
	 * &_getHandler
	 * 
	 * @param	void
	 * 
	 * @return	Playermap_ConneHandler
	**/
	protected function &_getHandler()
	{
		$handler =& $this->mAsset->getObject('handler', 'Conne');
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
		$render->setTemplateName($this->mAsset->mDirname . '_conne_view.html');
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
		$this->mRoot->mController->executeRedirect($this->_getNextUri('conne', 'list'), 1, _MD_PLAYERMAP_ERROR_CONTENT_IS_NOT_FOUND);
	}
}

?>
