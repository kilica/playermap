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
require_once RPGLINK_TRUST_PATH . '/class/CategoryManager.class.php';
/**
 * Rpglink_AbstractAction
**/
abstract class Rpglink_AbstractAction
{
	public /*** XCube_Root ***/ $mRoot = null;

	public /*** Rpglink_Module ***/ $mModule = null;

	public /*** Rpglink_AssetManager ***/ $mAsset = null;

	protected /*** string[] ***/ $_mScriptArr = array();

	/**
	 * __construct
	 * 
	 * @param	void
	 * 
	 * @return	void
	**/
	public function __construct()
	{
		$this->mRoot =& XCube_Root::getSingleton();
		$this->mModule =& $this->mRoot->mContext->mModule;
		$this->mAsset =& $this->mModule->mAssetManager;
	}

	/**
	 * getPageTitle
	 * 
	 * @param	void
	 * 
	 * @return	string
	**/
	public function getPagetitle()
	{
		///XCL2.2 only
		return Legacy_Utils::formatPagetitle($this->mRoot->mContext->mModule->mXoopsModule->get('name'), $this->_getTitle(), $this->_getActionName());
	}

	/**
	 * _getPageTitle
	 * 
	 * @param	void
	 * 
	 * @return	string
	**/
	protected function _getTitle()
	{
		if(! $this->mObject) return null;
		if($this->mObject->getShow('title')){
			return $this->mObject->getShow('title');
		}
		else{
			return null;
		}
	}

	/**
	 * _getActionName
	 * 
	 * @param	void
	 * 
	 * @return	string
	**/
	protected function _getActionName()
	{
		return null;
	}

	/**
	 * _getDatePickerScript
	 * 
	 * @param	void
	 * 
	 * @return	String
	**/
	protected function _getDatePickerScript()
	{
		return '$(".datePicker").each(function(){$(this).datepicker({dateFormat: "'._JSDATEPICKSTRING.'"});});';
	}

	/**
	 * _getRpgSelectScript
	 * 
	 * @param	void
	 * 
	 * @return	string
	**/
	protected function _getRpgSelectScript()
	{
		$searchList = Playermap_Utils::getSearchList('rpg');
	
		$idString = implode(',', $searchList['id']);
		$titleString = '"'. implode('","', $searchList['title']) .'"';
		$searchString = '"'. implode('","', $searchList['search']) .'"';
		return sprintf('var arr={"title":[%s],"search":[%s],"id":[%s]};$("#incsearch").add_incsearch_on($("#rpgSelect"),arr);',$titleString,$searchString,$idString);
	}

	/**
	 * _getStylesheet
	 * 
	 * @param	void
	 * 
	 * @return	String
	**/
	protected function _getStylesheet()
	{
		return $this->mRoot->mContext->mModuleConfig['css_file'];
	}

	/**
	 * _setupScript
	 * 
	 * @param	void
	 * 
	 * @return	void
	**/
	protected function _setupScript($script)
	{
		$headerScript = $this->mRoot->mContext->getAttribute('headerScript');
		
		switch($script){
		case 'incSearch':
			$headerScript->addLibrary('/modules/'.$this->mAsset->mDirname.'/incsearch.js');
			$headerScript->addScript($this->_getIncSearchScript());
			break;
		case 'rpgSelect':
			$headerScript->addLibrary('/modules/'.PLAYERMAP_DIRNAME.'/rpgselect.js');
			$headerScript->addScript($this->_getRpgSelectScript());
			break;
		case 'datePicker':
			$headerScript->addScript('$(".datePicker").each(function(){$(this).datepicker({dateFormat: "'._JSDATEPICKSTRING.'"});});');
			break;
		case 'tab':
			$headerScript->addScript('$(".tab").tabs();');
			break;
		}
	}

	/**
	 * setHeaderScript
	 * 
	 * @param	void
	 * 
	 * @return	void
	**/
	public function setHeaderScript()
	{
		/// XCL2.2 only
		$headerScript = $this->mRoot->mContext->getAttribute('headerScript');
		$headerScript->addScript($this->_getDatePickerScript());
		$headerScript->addStylesheet($this->_getStylesheet());
	
		$scriptArr = $this->_mScriptArr;
		foreach($scriptArr as $script){
			$this->_setupScript($script);
		}
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
		require_once RPGLINK_TRUST_PATH . '/class/CategoryManager.class.php';
		$this->mRoot->mLanguageManager->loadModuleMessageCatalog(PLAYERMAP_DIRNAME);
		$this->mRoot->mLanguageManager->loadModuleMessageCatalog(TRPG_DIRNAME);
	
		return true;
	}

	/**
	 * hasPermission
	 * 
	 * @param	void
	 * 
	 * @return	bool
	**/
	public function hasPermission()
	{
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
		return RPGLINK_FRAME_VIEW_NONE;
	}

	/**
	 * execute
	 * 
	 * @param	void
	 * 
	 * @return	Enum
	**/
	public function execute()
	{
		return RPGLINK_FRAME_VIEW_NONE;
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
	}

	/**
	 * executeViewInput
	 * 
	 * @param	XCube_RenderTarget	&$render
	 * 
	 * @return	void
	**/
	public function executeViewInput(/*** XCube_RenderTarget ***/ &$render)
	{
	}

	/**
	 * executeViewPreview
	 * 
	 * @param	XCube_RenderTarget	&$render
	 * 
	 * @return	void
	**/
	public function executeViewPreview(/*** XCube_RenderTarget ***/ &$render)
	{
	}

	/**
	 * executeViewCancel
	 * 
	 * @param	XCube_RenderTarget	&$render
	 * 
	 * @return	void
	**/
	public function executeViewCancel(/*** XCube_RenderTarget ***/ &$render)
	{
	}

	/**
	 * _getNextUri
	 * 
	 * @param	void
	 * 
	 * @return	string
	**/
	protected function _getNextUri($tableName, $actionName=null)
	{
		$handler = $this->_getHandler();
		if($this->mObject->get($handler->mPrimary)>0){
			return Legacy_Utils::renderUri($this->mAsset->mDirname, $tableName, $this->mObject->get($handler->mPrimary), $actionName);
		}
		else{
			return Legacy_Utils::renderUri($this->mAsset->mDirname, $tableName, 0, $actionName);
		}
	}
}

?>
