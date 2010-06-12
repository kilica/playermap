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

require_once XOOPS_TRUST_PATH . '/modules/trpg/preload/AssetPreload.class.php';
Trpg_AssetPreloadBase::prepare(basename(dirname(dirname(__FILE__))));

?>
