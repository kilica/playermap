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

if(!defined('TRPG_TRUST_PATH'))
{
	define('TRPG_TRUST_PATH',XOOPS_TRUST_PATH . '/modules/trpg');
}

require_once TRPG_TRUST_PATH . '/class/TrpgUtils.class.php';
require_once TRPG_TRUST_PATH . '/class/Enum.class.php';

/**
 * Trpg_AssetPreloadBase
**/
class Trpg_AssetPreloadBase extends XCube_ActionFilter
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
		$file = TRPG_TRUST_PATH . '/class/DelegateFunctions.class.php';
	
		$this->mRoot->mDelegateManager->add('Module.trpg.Global.Event.GetAssetManager','Trpg_AssetPreloadBase::getManager');
		$this->mRoot->mDelegateManager->add('Legacy_Utils.CreateModule','Trpg_AssetPreloadBase::getModule');
		$this->mRoot->mDelegateManager->add('Legacy_Utils.CreateBlockProcedure','Trpg_AssetPreloadBase::getBlock');
		$this->mRoot->mDelegateManager->add('Module.trpg.Global.Event.GetNormalUri','Trpg_CoolUriDelegate::getNormalUri', $file);
		$this->mRoot->mDelegateManager->add('Legacy_ImageManager.GetClientModules','Trpg_ImageManagerClientDelegate::getClientModules', $file);
	}

	/**
	 * getManager
	 * 
	 * @param	Trpg_AssetManager  &$obj
	 * @param	string	$dirname
	 * 
	 * @return	void
	**/
	public static function getManager(/*** Trpg_AssetManager ***/ &$obj,/*** string ***/ $dirname)
	{
		require_once TRPG_TRUST_PATH . '/class/AssetManager.class.php';
		$obj = Trpg_AssetManager::getInstance($dirname);
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
		if($module->getInfo('trust_dirname') == 'trpg')
		{
			require_once TRPG_TRUST_PATH . '/class/Module.class.php';
			$obj = new Trpg_Module($module);
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
		$moduleHandler =& Trpg_Utils::getXoopsHandler('module');
		$module =& $moduleHandler->get($block->get('mid'));
		if(is_object($module) && $module->getInfo('trust_dirname') == 'trpg')
		{
			require_once TRPG_TRUST_PATH . '/blocks/' . $block->get('func_file');
			$className = 'Trpg_' . substr($block->get('show_func'), 4);
			$obj = new $className($block);
		}
	}
}

?>
