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

if(!defined('PLAYERMAP_TRUST_PATH'))
{
	define('PLAYERMAP_TRUST_PATH',XOOPS_TRUST_PATH . '/modules/playermap');
}

require_once PLAYERMAP_TRUST_PATH . '/class/PlayermapUtils.class.php';

/**
 * Playermap_AssetPreloadBase
**/
class Playermap_AssetPreloadBase extends XCube_ActionFilter
{
	/**
	 * prepare
	 * 
	 * @param	string	$dirname
	 * 
	 * @return	void
	**/
	public static function prepare(/*** string ***/ $dirname)
	{
		static $setupCompleted = false;
		if(!$setupCompleted)
		{
			$setupCompleted = self::_setup();
		}
	}

	/**
	 * _setup
	 * 
	 * @param	void
	 * 
	 * @return	bool
	**/
	public static function _setup()
	{
		$root =& XCube_Root::getSingleton();
		$instance = new self($root->mController);
		$root->mController->addActionFilter($instance);
		return true;
	}

	/**
	 * preBlockFilter
	 * 
	 * @param	void
	 * 
	 * @return	void
	**/
	public function preBlockFilter()
	{
		$file = PLAYERMAP_TRUST_PATH . '/class/DelegateFunctions.class.php';
	
		$this->mRoot->mDelegateManager->add('Module.playermap.Global.Event.GetAssetManager','Playermap_AssetPreloadBase::getManager');
		$this->mRoot->mDelegateManager->add('Legacy_Utils.CreateModule','Playermap_AssetPreloadBase::getModule');
		$this->mRoot->mDelegateManager->add('Legacy_Utils.CreateBlockProcedure','Playermap_AssetPreloadBase::getBlock');
		$this->mRoot->mDelegateManager->add('Module.playermap.Global.Event.GetNormalUri','Playermap_CoolUriDelegate::getNormalUri', $file);
	}

	/**
	 * getManager
	 * 
	 * @param	Playermap_AssetManager	&$obj
	 * @param	string	$dirname
	 * 
	 * @return	void
	**/
	public static function getManager(/*** Playermap_AssetManager ***/ &$obj,/*** string ***/ $dirname)
	{
		require_once PLAYERMAP_TRUST_PATH . '/class/AssetManager.class.php';
		$obj = Playermap_AssetManager::getInstance($dirname);
	}

	/**
	 * getModule
	 * 
	 * @param	Legacy_AbstractModule  &$obj
	 * @param	XoopsModule  $module
	 * 
	 * @return	void
	**/
	public static function getModule(/*** Legacy_AbstractModule ***/ &$obj,/*** XoopsModule ***/ $module)
	{
		if($module->getInfo('trust_dirname') == 'playermap')
		{
			require_once PLAYERMAP_TRUST_PATH . '/class/Module.class.php';
			$obj = new Playermap_Module($module);
		}
	}

	/**
	 * getBlock
	 * 
	 * @param	Legacy_AbstractBlockProcedure  &$obj
	 * @param	XoopsBlock	$block
	 * 
	 * @return	void
	**/
	public static function getBlock(/*** Legacy_AbstractBlockProcedure ***/ &$obj,/*** XoopsBlock ***/ $block)
	{
		$moduleHandler =& Playermap_Utils::getXoopsHandler('module');
		$module =& $moduleHandler->get($block->get('mid'));
		if(is_object($module) && $module->getInfo('trust_dirname') == 'playermap')
		{
			require_once PLAYERMAP_TRUST_PATH . '/blocks/' . $block->get('func_file');
			$className = 'Playermap_' . substr($block->get('show_func'), 4);
			$obj = new $className($block);
		}
	}
}

?>
