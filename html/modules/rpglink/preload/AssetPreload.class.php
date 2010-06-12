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

require_once XOOPS_TRUST_PATH . '/modules/rpglink/preload/AssetPreload.class.php';
Rpglink_AssetPreloadBase::prepare(basename(dirname(dirname(__FILE__))));

?>
