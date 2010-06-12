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

require_once TRPG_TRUST_PATH . '/class/AbstractViewAction.class.php';

/**
 * Trpg_RpgViewAction
**/
class Trpg_RpgViewAction extends Trpg_AbstractViewAction
{
	protected $_mScriptArr = array('rater', 'tab');

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
	 * _getRaterTarget
	 * 
	**/
	protected function _getRaterTarget()
	{
		return 'favrpg';
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
		$this->mObject->loadBook();
		$this->mCategoryManager['pub_id'] = new Trpg_CategoryManager($this->mAsset->mDirname, 'pub_id');

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
		$render->setTemplateName($this->mAsset->mDirname . '_rpg_view.html');
		$render->setAttribute('object', $this->mObject);
		$render->setAttribute('Pub_idTitle', $this->mCategoryManager['pub_id']->getTitle($this->mObject->get('pub_id')));
	
		$render->setAttribute('myrating', $this->mObject->getMyRating());
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
		$this->mRoot->mController->executeRedirect($this->_getNextUri('rpg', 'list'), 1, _MD_TRPG_ERROR_CONTENT_IS_NOT_FOUND);
	}
}

?>
