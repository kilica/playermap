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
 * Playermap_GroupViewAction
**/
class Playermap_GroupViewAction extends Playermap_AbstractViewAction
{
	protected $_mScriptArr=array('tab');

	/**
	 * &_getHandler
	 * 
	 * @param	void
	 * 
	 * @return	Playermap_GroupHandler
	**/
	protected function &_getHandler()
	{
		$handler =& $this->mAsset->getObject('handler', 'Group');
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
		$render->setTemplateName($this->mAsset->mDirname . '_group_view.html');
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
		$this->mRoot->mController->executeRedirect($this->_getNextUri('group', 'list'), 1, _MD_PLAYERMAP_ERROR_CONTENT_IS_NOT_FOUND);
	}
}

?>
