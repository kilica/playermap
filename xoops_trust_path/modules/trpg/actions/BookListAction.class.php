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

require_once TRPG_TRUST_PATH . '/class/AbstractListAction.class.php';

/**
 * Trpg_BookListAction
**/
class Trpg_BookListAction extends Trpg_AbstractListAction
{
	public $mDataname = 'book';
	protected $_mScriptArr = array('incSearch', 'rater');

	 /**
	 * &_getHandler
	 * 
	 * @param	void
	 * 
	 * @return	Trpg_BookHandler
	**/
	protected function &_getHandler()
	{
		$handler =& $this->mAsset->getObject('handler', 'Book');
		return $handler;
	}

	/**
	 * &_getFilterForm
	 * 
	 * @param	void
	 * 
	 * @return	Trpg_BookFilterForm
	**/
	protected function &_getFilterForm()
	{
		$filter =& $this->mAsset->getObject('filter', 'Book',false);
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
		return Legacy_Utils::renderUri($this->mAsset->mDirname, 'book');
	}

	/**
	 * _getRaterTarget
	 * 
	**/
	protected function _getRaterTarget()
	{
		return 'review';
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
	
		return TRPG_FRAME_VIEW_INDEX;
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
		$this->mCategoryManager['pub_id'] = new Trpg_CategoryManager($this->mAsset->mDirname, 'pub_id');

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
		$render->setTemplateName($this->mAsset->mDirname . '_book_list.html');
		#cubson::lazy_load_array('book', $this->mObjects);
		$render->setAttribute('objects', $this->mObjects);
		$render->setAttribute('dirname', $this->mAsset->mDirname);
		$render->setAttribute('dataname', 'book');
		$render->setAttribute('pageNavi', $this->mFilter->mNavi);
		$render->setAttribute('Pub_idTitleList', $this->mCategoryManager['pub_id']->getTitleList());
	}
}

?>
