<?php
/**
 * @file
 * @brief The page controller in the directory
 * @package playermap
 * @version $Id$
**/

require_once XOOPS_ROOT_PATH . '/header.php';

$root =& XCube_Root::getSingleton();

$root->mController->execute();

require_once XOOPS_ROOT_PATH . '/footer.php';

?>
