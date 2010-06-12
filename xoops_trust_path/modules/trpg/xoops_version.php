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

//
// Define a basic manifesto.
//
$modversion['name'] = _MI_TRPG_LANG_TRPG;
$modversion['version'] = 0.01;
$modversion['description'] = _MI_TRPG_DESC_TRPG;
$modversion['author'] = _MI_TRPG_LANG_AUTHOR;
$modversion['credits'] = _MI_TRPG_LANG_CREDITS;
$modversion['help'] = 'help.html';
$modversion['license'] = 'GPL';
$modversion['official'] = 0;
$modversion['image'] = 'images/module_icon.png';
$modversion['dirname'] = $myDirName;
$modversion['trust_dirname'] = 'trpg';

$modversion['cube_style'] = true;
$modversion['legacy_installer'] = array(
	'installer'   => array(
		'class' 	=> 'Installer',
		'namespace' => 'Trpg',
		'filepath'	=> TRPG_TRUST_PATH . '/admin/class/installer/TrpgInstaller.class.php'
	),
	'uninstaller' => array(
		'class' 	=> 'Uninstaller',
		'namespace' => 'Trpg',
		'filepath'	=> TRPG_TRUST_PATH . '/admin/class/installer/TrpgUninstaller.class.php'
	),
	'updater' => array(
		'class' 	=> 'Updater',
		'namespace' => 'Trpg',
		'filepath'	=> TRPG_TRUST_PATH . '/admin/class/installer/TrpgUpdater.class.php'
	)
);
$modversion['disable_legacy_2nd_installer'] = false;

$modversion['sqlfile']['mysql'] = 'sql/mysql.sql';
$modversion['tables'] = array(
//	  '{prefix}_{dirname}_xxxx',
##[cubson:tables]
	'{prefix}_{dirname}_rpg',
	'{prefix}_{dirname}_book',

##[/cubson:tables]
);

//
// Templates. You must never change [cubson] chunk to get the help of cubson.
//
$modversion['templates'] = array(
/*
	array(
		'file'		  => '{dirname}_xxx.html',
		'description' => _MI_TRPG_TPL_XXX
	),
*/
##[cubson:templates]
		array('file' => '{dirname}_rpg_delete.html','description' => _MI_TRPG_TPL_RPG_DELETE),
		array('file' => '{dirname}_rpg_edit.html','description' => _MI_TRPG_TPL_RPG_EDIT),
		array('file' => '{dirname}_rpg_list.html','description' => _MI_TRPG_TPL_RPG_LIST),
		array('file' => '{dirname}_rpg_select.html','description' => _MI_TRPG_TPL_RPG_SELECT),
		array('file' => '{dirname}_rpg_view.html','description' => _MI_TRPG_TPL_RPG_VIEW),
		array('file' => '{dirname}_book_delete.html','description' => _MI_TRPG_TPL_BOOK_DELETE),
		array('file' => '{dirname}_book_edit.html','description' => _MI_TRPG_TPL_BOOK_EDIT),
		array('file' => '{dirname}_book_list.html','description' => _MI_TRPG_TPL_BOOK_LIST),
		array('file' => '{dirname}_book_view.html','description' => _MI_TRPG_TPL_BOOK_VIEW),

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
		'title'    => _MI_TRPG_LANG_XXXX,
		'link'	   => 'admin/index.php?action=xxx',
		'keywords' => _MI_TRPG_KEYWORD_XXX,
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
		'name' => _MI_TRPG_LANG_SUB_XXX,
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
		'title' 		=> '_MI_TRPG_TITLE_XXXX',
		'description'	=> '_MI_TRPG_DESC_XXXX',
		'formtype'		=> 'xxxx',
		'valuetype' 	=> 'xxx',
		'options'		=> array(xxx => xxx,xxx => xxx),
		'default'		=> 0
	),
*/

	array(
		'name'			=> 'pub_id' ,
		'title' 		=> "_MI_TRPG_LANG_PUB_ID" ,
		'description'	=> "_MI_TRPG_DESC_PUB_ID" ,
		'formtype'		=> 'textbox' ,
		'valuetype' 	=> 'int' ,
		'default'		=>	0,
		'options'		=> array()
	) ,

	array(
		'name'			=> 'css_file' ,
		'title' 		=> "_MI_TRPG_LANG_CSS_FILE" ,
		'description'	=> "_MI_TRPG_DESC_CSS_FILE" ,
		'formtype'		=> 'textbox' ,
		'valuetype' 	=> 'text' ,
		'default'		=> '/modules/'.$myDirName.'/style.css',
		'options'		=> array()
	) ,

	array(
		'name'			=> 'rpg_image_set' ,
		'title' 		=> "_MI_TRPG_LANG_RPG_IMAGE_SET" ,
		'description'	=> "_MI_TRPG_DESC_RPG_IMAGE_SET" ,
		'formtype'		=> 'textbox' ,
		'valuetype' 	=> 'int' ,
		'default'		=>	1,
		'options'		=> array()
	) ,

	array(
		'name'			=> 'book_image_set' ,
		'title' 		=> "_MI_TRPG_LANG_BOOK_IMAGE_SET" ,
		'description'	=> "_MI_TRPG_DESC_BOOK_IMAGE_SET" ,
		'formtype'		=> 'textbox' ,
		'valuetype' 	=> 'int' ,
		'default'		=>	1,
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
		'name'				=> _MI_TRPG_BLOCK_NAME_xxx,
		'description'		=> _MI_TRPG_BLOCK_DESC_xxx,
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
