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

//
// Define a basic manifesto.
//
$modversion['name'] = _MI_RPGLINK_LANG_RPGLINK;
$modversion['version'] = 0.01;
$modversion['description'] = _MI_RPGLINK_DESC_RPGLINK;
$modversion['author'] = _MI_RPGLINK_LANG_AUTHOR;
$modversion['credits'] = _MI_RPGLINK_LANG_CREDITS;
$modversion['help'] = 'help.html';
$modversion['license'] = 'GPL';
$modversion['official'] = 0;
$modversion['image'] = 'images/module_icon.png';
$modversion['dirname'] = $myDirName;
$modversion['trust_dirname'] = 'rpglink';

$modversion['cube_style'] = true;
$modversion['legacy_installer'] = array(
	'installer'   => array(
		'class' 	=> 'Installer',
		'namespace' => 'Rpglink',
		'filepath'	=> RPGLINK_TRUST_PATH . '/admin/class/installer/RpglinkInstaller.class.php'
	),
	'uninstaller' => array(
		'class' 	=> 'Uninstaller',
		'namespace' => 'Rpglink',
		'filepath'	=> RPGLINK_TRUST_PATH . '/admin/class/installer/RpglinkUninstaller.class.php'
	),
	'updater' => array(
		'class' 	=> 'Updater',
		'namespace' => 'Rpglink',
		'filepath'	=> RPGLINK_TRUST_PATH . '/admin/class/installer/RpglinkUpdater.class.php'
	)
);
$modversion['disable_legacy_2nd_installer'] = false;

$modversion['sqlfile']['mysql'] = 'sql/mysql.sql';
$modversion['tables'] = array(
//	  '{prefix}_{dirname}_xxxx',
##[cubson:tables]
	'{prefix}_{dirname}_link',
	'{prefix}_{dirname}_update',
	'{prefix}_{dirname}_lrpg',

##[/cubson:tables]
);

//
// Templates. You must never change [cubson] chunk to get the help of cubson.
//
$modversion['templates'] = array(
/*
	array(
		'file'		  => '{dirname}_xxx.html',
		'description' => _MI_RPGLINK_TPL_XXX
	),
*/
##[cubson:templates]
		array('file' => '{dirname}_link_delete.html','description' => _MI_RPGLINK_TPL_LINK_DELETE),
		array('file' => '{dirname}_link_edit.html','description' => _MI_RPGLINK_TPL_LINK_EDIT),
		array('file' => '{dirname}_link_list.html','description' => _MI_RPGLINK_TPL_LINK_LIST),
		array('file' => '{dirname}_link_view.html','description' => _MI_RPGLINK_TPL_LINK_VIEW),
		array('file' => '{dirname}_update_edit.html','description' => _MI_RPGLINK_TPL_UPDATE_EDIT),
		array('file' => '{dirname}_update_view.html','description' => _MI_RPGLINK_TPL_UPDATE_VIEW),
		array('file' => '{dirname}_lrpg_edit.html','description' => _MI_RPGLINK_TPL_LRPG_EDIT),

##[/cubson:templates]
);

//
// Admin panel setting
//
$modversion['hasAdmin'] = 1;
$modversion['adminindex'] = 'admin/index.php?action=Index';
$modversion['adminmenu'] = array(
/*
	array(
		'title'    => _MI_RPGLINK_LANG_XXXX,
		'link'	   => 'admin/index.php?action=xxx',
		'keywords' => _MI_RPGLINK_KEYWORD_XXX,
		'show'	   => true,
		'absolute' => false
	),
*/
##[cubson:adminmenu]
##[/cubson:adminmenu]
);

//
// Public side control setting
//
$modversion['hasMain'] = 1;
$modversion['hasSearch'] = 0;
$modversion['sub'] = array(
/*
	array(
		'name' => _MI_RPGLINK_LANG_SUB_XXX,
		'url'  => 'index.php?action=XXX'
	),
*/
##[cubson:submenu]
##[/cubson:submenu]
);

//
// Config setting
//
$modversion['config'] = array(
/*
	array(
		'name'			=> 'xxxx',
		'title' 		=> '_MI_RPGLINK_TITLE_XXXX',
		'description'	=> '_MI_RPGLINK_DESC_XXXX',
		'formtype'		=> 'xxxx',
		'valuetype' 	=> 'xxx',
		'options'		=> array(xxx => xxx,xxx => xxx),
		'default'		=> 0
	),
*/

	array(
		'name'			=> 'pref_id' ,
		'title' 		=> "_MI_RPGLINK_LANG_PREF_ID" ,
		'description'	=> "_MI_RPGLINK_DESC_PREF_ID" ,
		'formtype'		=> 'textbox' ,
		'valuetype' 	=> 'int' ,
		'default'		=>	0,
		'options'		=> array()
	) ,

	array(
		'name'			=> 'css_file' ,
		'title' 		=> "_MI_RPGLINK_LANG_CSS_FILE" ,
		'description'	=> "_MI_RPGLINK_DESC_CSS_FILE" ,
		'formtype'		=> 'textbox' ,
		'valuetype' 	=> 'text' ,
		'default'		=> '/modules/'.$myDirName.'/style.css',
		'options'		=> array()
	) ,
##[cubson:config]
##[/cubson:config]
);

//
// Block setting
//
$modversion['blocks'] = array(
/*
	x => array(
		'func_num'			=> x,
		'file'				=> 'xxxBlock.class.php',
		'class' 			=> 'xxx',
		'name'				=> _MI_RPGLINK_BLOCK_NAME_xxx,
		'description'		=> _MI_RPGLINK_BLOCK_DESC_xxx,
		'options'			=> '',
		'template'			=> '{dirname}_block_xxx.html',
		'show_all_module'	=> true,
		'visible_any'		=> true
	),
*/
##[cubson:block]
##[/cubson:block]
);

?>
