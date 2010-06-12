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
 * Playermap_PlayerViewAction
**/
class Playermap_PlayerViewAction extends Playermap_AbstractViewAction
{
	protected $_mScriptArr = array('tab', 'like');

	/**
	 * &_getHandler
	 * 
	 * @param	void
	 * 
	 * @return	Playermap_PlayerHandler
	**/
	protected function &_getHandler()
	{
		$handler =& $this->mAsset->getObject('handler', 'Player');
		return $handler;
	}

	/**
	 * _getLikeTarget
	 * 
	**/
	protected function _getLikeTarget()
	{
		return 'conne';
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
		$this->mCategoryManager['pref_id'] = new Playermap_CategoryManager($this->mAsset->mDirname, 'pref_id');

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
		$render->setTemplateName($this->mAsset->mDirname . '_player_view.html');
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
		$this->mRoot->mController->executeRedirect($this->_getNextUri('player', 'list'), 1, _MD_PLAYERMAP_ERROR_CONTENT_IS_NOT_FOUND);
	}
}

?>
