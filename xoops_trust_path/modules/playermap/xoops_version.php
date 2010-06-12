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

//
// Define a basic manifesto.
//
$modversion['name'] = _MI_PLAYERMAP_LANG_PLAYERMAP;
$modversion['version'] = 0.01;
$modversion['description'] = _MI_PLAYERMAP_DESC_PLAYERMAP;
$modversion['author'] = _MI_PLAYERMAP_LANG_AUTHOR;
$modversion['credits'] = _MI_PLAYERMAP_LANG_CREDITS;
$modversion['help'] = 'help.html';
$modversion['license'] = 'GPL';
$modversion['official'] = 0;
$modversion['image'] = 'images/module_icon.png';
$modversion['dirname'] = $myDirName;
$modversion['trust_dirname'] = 'playermap';

$modversion['cube_style'] = true;
$modversion['legacy_installer'] = array(
	'installer'   => array(
		'class' 	=> 'Installer',
		'namespace' => 'Playermap',
		'filepath'	=> PLAYERMAP_TRUST_PATH . '/admin/class/installer/PlayermapInstaller.class.php'
	),
	'uninstaller' => array(
		'class' 	=> 'Uninstaller',
		'namespace' => 'Playermap',
		'filepath'	=> PLAYERMAP_TRUST_PATH . '/admin/class/installer/PlayermapUninstaller.class.php'
	),
	'updater' => array(
		'class' 	=> 'Updater',
		'namespace' => 'Playermap',
		'filepath'	=> PLAYERMAP_TRUST_PATH . '/admin/class/installer/PlayermapUpdater.class.php'
	)
);
$modversion['disable_legacy_2nd_installer'] = false;

$modversion['sqlfile']['mysql'] = 'sql/mysql.sql';
$modversion['tables'] = array(
//	  '{prefix}_{dirname}_xxxx',
##[cubson:tables]
	'{prefix}_{dirname}_player',
	'{prefix}_{dirname}_conne',
	'{prefix}_{dirname}_group',
	'{prefix}_{dirname}_circle',
	'{prefix}_{dirname}_member',
	'{prefix}_{dirname}_favrpg',
	'{prefix}_{dirname}_review',
	'{prefix}_{dirname}_permission',
	'{prefix}_{dirname}_log',
	'{prefix}_{dirname}_entry',
	'{prefix}_{dirname}_conv',
	'{prefix}_{dirname}_recruit',

##[/cubson:tables]
);

//
// Templates. You must never change [cubson] chunk to get the help of cubson.
//
$modversion['templates'] = array(
/*
	array(
		'file'		  => '{dirname}_xxx.html',
		'description' => _MI_PLAYERMAP_TPL_XXX
	),
*/
##[cubson:templates]
		array('file' => '{dirname}_player_delete.html','description' => _MI_PLAYERMAP_TPL_PLAYER_DELETE),
		array('file' => '{dirname}_player_edit.html','description' => _MI_PLAYERMAP_TPL_PLAYER_EDIT),
		array('file' => '{dirname}_player_list.html','description' => _MI_PLAYERMAP_TPL_PLAYER_LIST),
		array('file' => '{dirname}_player_view.html','description' => _MI_PLAYERMAP_TPL_PLAYER_VIEW),
		array('file' => '{dirname}_conne_delete.html','description' => _MI_PLAYERMAP_TPL_CONNE_DELETE),
		array('file' => '{dirname}_conne_edit.html','description' => _MI_PLAYERMAP_TPL_CONNE_EDIT),
		array('file' => '{dirname}_conne_list.html','description' => _MI_PLAYERMAP_TPL_CONNE_LIST),
		array('file' => '{dirname}_conne_view.html','description' => _MI_PLAYERMAP_TPL_CONNE_VIEW),
		array('file' => '{dirname}_group_delete.html','description' => _MI_PLAYERMAP_TPL_GROUP_DELETE),
		array('file' => '{dirname}_group_edit.html','description' => _MI_PLAYERMAP_TPL_GROUP_EDIT),
		array('file' => '{dirname}_group_list.html','description' => _MI_PLAYERMAP_TPL_GROUP_LIST),
		array('file' => '{dirname}_group_view.html','description' => _MI_PLAYERMAP_TPL_GROUP_VIEW),
		array('file' => '{dirname}_circle_delete.html','description' => _MI_PLAYERMAP_TPL_CIRCLE_DELETE),
		array('file' => '{dirname}_circle_edit.html','description' => _MI_PLAYERMAP_TPL_CIRCLE_EDIT),
		array('file' => '{dirname}_circle_list.html','description' => _MI_PLAYERMAP_TPL_CIRCLE_LIST),
		array('file' => '{dirname}_circle_view.html','description' => _MI_PLAYERMAP_TPL_CIRCLE_VIEW),
		array('file' => '{dirname}_member_delete.html','description' => _MI_PLAYERMAP_TPL_MEMBER_DELETE),
		array('file' => '{dirname}_member_edit.html','description' => _MI_PLAYERMAP_TPL_MEMBER_EDIT),
		array('file' => '{dirname}_member_list.html','description' => _MI_PLAYERMAP_TPL_MEMBER_LIST),
		array('file' => '{dirname}_member_view.html','description' => _MI_PLAYERMAP_TPL_MEMBER_VIEW),
		array('file' => '{dirname}_favrpg_delete.html','description' => _MI_PLAYERMAP_TPL_FAVRPG_DELETE),
		array('file' => '{dirname}_favrpg_edit.html','description' => _MI_PLAYERMAP_TPL_FAVRPG_EDIT),
		array('file' => '{dirname}_favrpg_list.html','description' => _MI_PLAYERMAP_TPL_FAVRPG_LIST),
		array('file' => '{dirname}_favrpg_view.html','description' => _MI_PLAYERMAP_TPL_FAVRPG_VIEW),
		array('file' => '{dirname}_review_delete.html','description' => _MI_PLAYERMAP_TPL_REVIEW_DELETE),
		array('file' => '{dirname}_review_edit.html','description' => _MI_PLAYERMAP_TPL_REVIEW_EDIT),
		array('file' => '{dirname}_review_list.html','description' => _MI_PLAYERMAP_TPL_REVIEW_LIST),
		array('file' => '{dirname}_review_view.html','description' => _MI_PLAYERMAP_TPL_REVIEW_VIEW),
		array('file' => '{dirname}_log_delete.html','description' => _MI_PLAYERMAP_TPL_LOG_DELETE),
		array('file' => '{dirname}_log_edit.html','description' => _MI_PLAYERMAP_TPL_LOG_EDIT),
		array('file' => '{dirname}_log_list.html','description' => _MI_PLAYERMAP_TPL_LOG_LIST),
		array('file' => '{dirname}_log_view.html','description' => _MI_PLAYERMAP_TPL_LOG_VIEW),
		array('file' => '{dirname}_entry_delete.html','description' => _MI_PLAYERMAP_TPL_ENTRY_DELETE),
		array('file' => '{dirname}_entry_edit.html','description' => _MI_PLAYERMAP_TPL_ENTRY_EDIT),
		array('file' => '{dirname}_entry_list.html','description' => _MI_PLAYERMAP_TPL_ENTRY_LIST),
		array('file' => '{dirname}_entry_view.html','description' => _MI_PLAYERMAP_TPL_ENTRY_VIEW),
		array('file' => '{dirname}_conv_delete.html','description' => _MI_PLAYERMAP_TPL_CONV_DELETE),
		array('file' => '{dirname}_conv_edit.html','description' => _MI_PLAYERMAP_TPL_CONV_EDIT),
		array('file' => '{dirname}_conv_list.html','description' => _MI_PLAYERMAP_TPL_CONV_LIST),
		array('file' => '{dirname}_conv_view.html','description' => _MI_PLAYERMAP_TPL_CONV_VIEW),
		array('file' => '{dirname}_recruit_delete.html','description' => _MI_PLAYERMAP_TPL_RECRUIT_DELETE),
		array('file' => '{dirname}_recruit_edit.html','description' => _MI_PLAYERMAP_TPL_RECRUIT_EDIT),
		array('file' => '{dirname}_recruit_list.html','description' => _MI_PLAYERMAP_TPL_RECRUIT_LIST),
		array('file' => '{dirname}_recruit_view.html','description' => _MI_PLAYERMAP_TPL_RECRUIT_VIEW),
		array('file' => '{dirname}_entry_schedule.html','description' => _MI_PLAYERMAP_TPL_ENTRY_EDIT),
##[/cubson:templates]
);

//
// Admin panel setting
//
$modversion['hasAdmin'] = 1;
$modversion['adminindex'] = 'admin/index.php?action=Index';
$modversion['adminmenu'] = array(
	array(
		'title'    => _MI_PLAYERMAP_LANG_THUMBNAIL_SETTING,
		'link'	   => 'admin/index.php?action=ThumbnailSetting',
		'keywords' => _MI_PLAYERMAP_KEYWORD_THUMBNAIL_SETTING,
		'show'	   => true,
		'absolute' => false
	),
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
		'name' => _MI_PLAYERMAP_LANG_SUB_XXX,
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
		'title' 		=> '_MI_PLAYERMAP_TITLE_XXXX',
		'description'	=> '_MI_PLAYERMAP_DESC_XXXX',
		'formtype'		=> 'xxxx',
		'valuetype' 	=> 'xxx',
		'options'		=> array(xxx => xxx,xxx => xxx),
		'default'		=> 0
	),
*/

	array(
		'name'			=> 'pref_id' ,
		'title' 		=> "_MI_PLAYERMAP_LANG_PREF_ID" ,
		'description'	=> "_MI_PLAYERMAP_DESC_PREF_ID" ,
		'formtype'		=> 'textbox' ,
		'valuetype' 	=> 'int' ,
		'default'		=>	0,
		'options'		=> array()
	) ,

	array(
		'name'			=> 'css_file' ,
		'title' 		=> "_MI_PLAYERMAP_LANG_CSS_FILE" ,
		'description'	=> "_MI_PLAYERMAP_DESC_CSS_FILE" ,
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
		'name'				=> _MI_PLAYERMAP_BLOCK_NAME_xxx,
		'description'		=> _MI_PLAYERMAP_BLOCK_DESC_xxx,
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
