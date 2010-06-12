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
require_once PLAYERMAP_TRUST_PATH . '/class/CategoryManager.class.php';
/**
 * Playermap_AbstractAction
**/
abstract class Playermap_AbstractAction
{
	public /*** XCube_Root ***/ $mRoot = null;

	public /*** Playermap_Module ***/ $mModule = null;

	public /*** Playermap_AssetManager ***/ $mAsset = null;

	public /*** string ***/ $mDataname = null;

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
			$headerScript->addLibrary('/modules/'.$this->mAsset->mDirname.'/rpgselect.js');
			$headerScript->addScript($this->_getRpgSelectScript());
			break;
		case 'datePicker':
			$headerScript->addScript('$(".datePicker").each(function(){$(this).datepicker({dateFormat: "'._JSDATEPICKSTRING.'"});});');
			break;
		case 'tab':
			$headerScript->addScript('$(".tab").tabs();');
			break;
		case 'map':
			$headerScript->addScript('google.load("maps", "2");',false);
			$headerScript->addScript('function initialize() {
  var map = new google.maps.Map2($("#map"));
  map.setCenter(new google.maps.LatLng(37.4419, -122.1419), 13);}');
  			break;
		case 'rater':
			$headerScript->addLibrary('/common/jquery/rater/jquery.ui.stars.js');
			$headerScript->addStylesheet('/common/jquery/rater/style.css');
			$headerScript->addScript(sprintf('$(".fav-rater").each(function(){var selected=this;$(this).stars({"cancelShow": false,"callback": function(ui, type, value){$.post("%s", {rating: value, target_id: $(selected).attr("id")}, function(json) {
	$("#fake-stars-on").width(Math.round( $("#fake-stars-off").width() / ui.options.items * parseFloat(json.avg) ));
	$("#fake-stars-cap").text(json.avg + " (" + json.votes + ")");});}});});', Legacy_Utils::renderUri($this->mAsset->mDirname, $this->_getRaterTarget(), 0, 'rater')));
			break;
		case 'like':
			$headerScript->addLibrary('/common/jquery/rater/jquery.ui.stars.js');
			$headerScript->addStylesheet('/common/jquery/rater/style.css');
			$headerScript->addScript(sprintf('$(".like").each(function(){var selected=this;$(this).stars({"cancelShow": false,"callback": function(ui, type, value){$.post("%s", {rating: value, target_id: $(selected).attr("id")}, function(json) {$(selected).attr("value",$(selected+">div>a").html()*-1);});}});});', Legacy_Utils::renderUri($this->mAsset->mDirname, $this->_getLikeTarget(), 0, 'like')));
			break;
		}
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
	 * _getIncSearchScript
	 * 
	 * @param	void
	 * 
	 * @return	string
	**/
	protected function _getIncSearchScript()
	{
		$searchList = Playermap_Utils::getSearchList($this->mDataname);
	
		$listDirname = ($this->mDataname=='rpg'||$this->mDataname=='book') ? TRPG_DIRNAME : PLAYERMAP_DIRNAME;
		$base = rtrim(Legacy_Utils::renderUri($listDirname, $this->mDataname, 1),1);
	
		$idString = implode(',', $searchList['id']);
		$titleString = '"'. implode('","', $searchList['title']) .'"';
		$searchString = '"'. implode('","', $searchList['search']) .'"';
		return sprintf('var arr={"title":[%s],"search":[%s],"id":[%s]};$("#incsearch").add_incsearch_on($("#searchList"),arr,"%s");',$titleString,$searchString,$idString,$base);
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
		//$headerScript->addScript($this->_getDatePickerScript());
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
		require_once PLAYERMAP_TRUST_PATH . '/class/CategoryManager.class.php';			$this->mRoot->mLanguageManager->loadModuleMessageCatalog(TRPG_DIRNAME);
		$this->mRoot->mLanguageManager->loadModuleMessageCatalog(RPGLINK_DIRNAME);
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
		return PLAYERMAP_FRAME_VIEW_NONE;
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
		return PLAYERMAP_FRAME_VIEW_NONE;
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
