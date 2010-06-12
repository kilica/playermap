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

require_once XOOPS_TRUST_PATH . '/modules/playermap/preload/AssetPreload.class.php';
Playermap_AssetPreloadBase::prepare(basename(dirname(dirname(__FILE__))));

?>
