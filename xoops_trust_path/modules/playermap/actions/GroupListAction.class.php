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
 * Playermap_GroupListAction
**/
class Playermap_GroupListAction extends Playermap_AbstractListAction
{
	public $mDataname = 'group';
	protected $_mScriptArr = array('incSearch');

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
	 * &_getFilterForm
	 * 
	 * @param	void
	 * 
	 * @return	Playermap_GroupFilterForm
	**/
	protected function &_getFilterForm()
	{
		$filter =& $this->mAsset->getObject('filter', 'Group',false);
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
		return './index.php?action=GroupList';
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
		$render->setTemplateName($this->mAsset->mDirname . '_group_list.html');
		#cubson::lazy_load_array('group', $this->mObjects);
		$render->setAttribute('objects', $this->mObjects);
		$render->setAttribute('dirname', $this->mAsset->mDirname);
		$render->setAttribute('dataname', 'group');
		$render->setAttribute('pageNavi', $this->mFilter->mNavi);
	}

	/**
	 * _getIncSearchScript
	 * 
	 * @param	void
	 * 
	 * @return	string
	**/
	protected function _getIncSearchScript()
	{
		$searchList = Playermap_Utils::getSearchList('group');
	
		$base = rtrim(Legacy_Utils::renderUri($this->mAsset->mDirname, 'group', 1),1);
		
		$idString = implode(',', $searchList['id']);
		$titleString = '"'. implode('","', $searchList['title']) .'"';
		$searchString = '"'. implode('","', $searchList['search']) .'"';
		return sprintf('var arr={"title":[%s],"search":[%s],"id":[%s]};$("#incsearch").add_incsearch_on($("#searchList"),arr,"%s");',$titleString,$searchString,$idString,$base);
	}
}

?>
