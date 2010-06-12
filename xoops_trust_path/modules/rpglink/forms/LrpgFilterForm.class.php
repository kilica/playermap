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

require_once RPGLINK_TRUST_PATH . '/class/AbstractFilterForm.class.php';

define('RPGLINK_LRPG_SORT_KEY_LRPG_ID', 1);
define('RPGLINK_LRPG_SORT_KEY_RPG_ID', 2);
define('RPGLINK_LRPG_SORT_KEY_LINK_ID', 3);
define('RPGLINK_LRPG_SORT_KEY_POSTTIME', 4);

define('RPGLINK_LRPG_SORT_KEY_DEFAULT', RPGLINK_LRPG_SORT_KEY_LRPG_ID);

/**
 * Rpglink_LrpgFilterForm
**/
class Rpglink_LrpgFilterForm extends Rpglink_AbstractFilterForm
{
    public /*** string[] ***/ $mSortKeys = array(
 	   RPGLINK_LRPG_SORT_KEY_LRPG_ID => 'lrpg_id',
 	   RPGLINK_LRPG_SORT_KEY_RPG_ID => 'rpg_id',
 	   RPGLINK_LRPG_SORT_KEY_LINK_ID => 'link_id',
 	   RPGLINK_LRPG_SORT_KEY_POSTTIME => 'posttime',

    );

    /**
     * getDefaultSortKey
     * 
     * @param   void
     * 
     * @return  void
    **/
    public function getDefaultSortKey()
    {
        return RPGLINK_LRPG_SORT_KEY_DEFAULT;
    }

    /**
     * fetch
     * 
     * @param   void
     * 
     * @return  void
    **/
    public function fetch()
    {
        parent::fetch();
    
        $root =& XCube_Root::getSingleton();
    
		if (($value = $root->mContext->mRequest->getRequest('lrpg_id')) !== null) {
			$this->mNavi->addExtra('lrpg_id', $value);
			$this->_mCriteria->add(new Criteria('lrpg_id', $value));
		}
		if (($value = $root->mContext->mRequest->getRequest('rpg_id')) !== null) {
			$this->mNavi->addExtra('rpg_id', $value);
			$this->_mCriteria->add(new Criteria('rpg_id', $value));
		}
		if (($value = $root->mContext->mRequest->getRequest('link_id')) !== null) {
			$this->mNavi->addExtra('link_id', $value);
			$this->_mCriteria->add(new Criteria('link_id', $value));
		}
		if (($value = $root->mContext->mRequest->getRequest('posttime')) !== null) {
			$this->mNavi->addExtra('posttime', $value);
			$this->_mCriteria->add(new Criteria('posttime', $value));
		}

    
        $this->_mCriteria->addSort($this->getSort(), $this->getOrder());
    }
}

?>
