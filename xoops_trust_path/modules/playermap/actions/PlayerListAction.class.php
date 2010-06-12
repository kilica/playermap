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

require_once PLAYERMAP_TRUST_PATH . '/class/AbstractListAction.class.php';

/**
 * Playermap_PlayerListAction
**/
class Playermap_PlayerListAction extends Playermap_AbstractListAction
{
	public $mDataname = 'player';
	protected $_mScriptArr = array('incSearch');

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
	 * &_getFilterForm
	 * 
	 * @param	void
	 * 
	 * @return	Playermap_PlayerFilterForm
	**/
	protected function &_getFilterForm()
	{
		$filter =& $this->mAsset->getObject('filter', 'Player',false);
		$filter->prepare($this->_getPageNavi(), $this->_getHandler());
		return $filter;
	}

	/**
	 * _getBaseUrl
	 * 
	 * @param	void
	 * 
	 * @return	string
	**/
	protected function _getBaseUrl()
	{
		return './index.php?action=PlayerList';
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
	 * executeViewIndex
	 * 
	 * @param	XCube_RenderTarget	&$render
	 * 
	 * @return	void
	**/
	public function executeViewIndex(/*** XCube_RenderTarget ***/ &$render)
	{
		$render->setTemplateName($this->mAsset->mDirname . '_player_list.html');
		#cubson::lazy_load_array('player', $this->mObjects);
		$render->setAttribute('objects', $this->mObjects);
		$render->setAttribute('dirname', $this->mAsset->mDirname);
		$render->setAttribute('dataname', 'player');
		$render->setAttribute('pageNavi', $this->mFilter->mNavi);
		$render->setAttribute('Pref_idTitleList', $this->mCategoryManager['pref_id']->getTitleList());
	}
}

?>
