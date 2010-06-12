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
 * Playermap_ConneListAction
**/
class Playermap_ConneListAction extends Playermap_AbstractListAction
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
	 * &_getFilterForm
	 * 
	 * @param	void
	 * 
	 * @return	Playermap_ConneFilterForm
	**/
	protected function &_getFilterForm()
	{
		$filter =& $this->mAsset->getObject('filter', 'Conne',false);
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
		return './index.php?action=ConneList';
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
	 * executeViewIndex
	 * 
	 * @param	XCube_RenderTarget	&$render
	 * 
	 * @return	void
	**/
	public function executeViewIndex(/*** XCube_RenderTarget ***/ &$render)
	{
		$render->setTemplateName($this->mAsset->mDirname . '_conne_list.html');
		#cubson::lazy_load_array('conne', $this->mObjects);
		$render->setAttribute('objects', $this->mObjects);
		$render->setAttribute('dirname', $this->mAsset->mDirname);
		$render->setAttribute('dataname', 'conne');
		$render->setAttribute('pageNavi', $this->mFilter->mNavi);
	}
}

?>
