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
 * Playermap_FavrpgListAction
**/
class Playermap_FavrpgListAction extends Playermap_AbstractListAction
{
	protected $_mScriptArr = array('rater');

	 /**
	 * &_getHandler
	 * 
	 * @param	void
	 * 
	 * @return	Playermap_FavrpgHandler
	**/
	protected function &_getHandler()
	{
		$handler =& $this->mAsset->getObject('handler', 'Favrpg');
		return $handler;
	}

	/**
	 * &_getFilterForm
	 * 
	 * @param	void
	 * 
	 * @return	Playermap_FavrpgFilterForm
	**/
	protected function &_getFilterForm()
	{
		$filter =& $this->mAsset->getObject('filter', 'Favrpg',false);
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
		return './index.php?action=FavrpgList';
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
		parent::getDefaultView();
		foreach(array_keys($this->mObjects) as $key){
			$this->mObjects[$key]->loadRpg();
		}
		return PLAYERMAP_FRAME_VIEW_INDEX;
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
		$render->setTemplateName($this->mAsset->mDirname . '_favrpg_list.html');
		#cubson::lazy_load_array('favrpg', $this->mObjects);
		$render->setAttribute('objects', $this->mObjects);
		$render->setAttribute('dirname', $this->mAsset->mDirname);
		$render->setAttribute('dataname', 'favrpg');
		$render->setAttribute('pageNavi', $this->mFilter->mNavi);
	}
}

?>
