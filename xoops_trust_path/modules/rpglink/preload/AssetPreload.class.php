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

if(!defined('RPGLINK_TRUST_PATH'))
{
	define('RPGLINK_TRUST_PATH',XOOPS_TRUST_PATH . '/modules/rpglink');
}

require_once RPGLINK_TRUST_PATH . '/class/RpglinkUtils.class.php';

/**
 * Rpglink_AssetPreloadBase
**/
class Rpglink_AssetPreloadBase extends XCube_ActionFilter
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
		$file = RPGLINK_TRUST_PATH . '/class/DelegateFunctions.class.php';
		$this->mRoot->mDelegateManager->add('Module.rpglink.Global.Event.GetAssetManager','Rpglink_AssetPreloadBase::getManager');
		$this->mRoot->mDelegateManager->add('Legacy_Utils.CreateModule','Rpglink_AssetPreloadBase::getModule');
		$this->mRoot->mDelegateManager->add('Legacy_Utils.CreateBlockProcedure','Rpglink_AssetPreloadBase::getBlock');
		$this->mRoot->mDelegateManager->add('Module.rpglink.Global.Event.GetNormalUri','Rpglink_CoolUriDelegate::getNormalUri', $file);
	}

	/**
	 * getManager
	 * 
	 * @param	Rpglink_AssetManager  &$obj
	 * @param	string	$dirname
	 * 
	 * @return	void
	**/
	public static function getManager(/*** Rpglink_AssetManager ***/ &$obj,/*** string ***/ $dirname)
	{
		require_once RPGLINK_TRUST_PATH . '/class/AssetManager.class.php';
		$obj = Rpglink_AssetManager::getInstance($dirname);
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
		if($module->getInfo('trust_dirname') == 'rpglink')
		{
			require_once RPGLINK_TRUST_PATH . '/class/Module.class.php';
			$obj = new Rpglink_Module($module);
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
		$moduleHandler =& Rpglink_Utils::getXoopsHandler('module');
		$module =& $moduleHandler->get($block->get('mid'));
		if(is_object($module) && $module->getInfo('trust_dirname') == 'rpglink')
		{
			require_once RPGLINK_TRUST_PATH . '/blocks/' . $block->get('func_file');
			$className = 'Rpglink_' . substr($block->get('show_func'), 4);
			$obj = new $className($block);
		}
	}
}

?>
