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
 * Rpglink_LinkViewAction
**/
class Rpglink_LinkViewAction extends Rpglink_AbstractViewAction
{
	protected $_mScriptArr = array('tab');

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
	 * prepare
	 * 
	 * @param	void
	 * 
	 * @return	bool
	**/
	public function prepare()
	{
		parent::prepare();
		$this->mCategoryManager['pref_id'] = new Rpglink_CategoryManager($this->mAsset->mDirname, 'pref_id');
		$this->mObject->loadUpdate();
		$this->mObject->loadLrpg();
	
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
		$render->setTemplateName($this->mAsset->mDirname . '_link_view.html');
		$render->setAttribute('object', $this->mObject);
		$render->setAttribute('Pref_idTitle', $this->mCategoryManager['pref_id']->getTitle($this->mObject->get('pref_id')));
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
		$this->mRoot->mController->executeRedirect($this->_getNextUri('link', 'list'), 1, _MD_RPGLINK_ERROR_CONTENT_IS_NOT_FOUND);
	}
}

?>
