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

require_once PLAYERMAP_TRUST_PATH . '/class/AbstractFilterForm.class.php';

define('PLAYERMAP_FAVRPG_SORT_KEY_FAVRPG_ID', 1);
define('PLAYERMAP_FAVRPG_SORT_KEY_RPG_ID', 2);
define('PLAYERMAP_FAVRPG_SORT_KEY_UID', 3);
define('PLAYERMAP_FAVRPG_SORT_KEY_RATING', 4);
define('PLAYERMAP_FAVRPG_SORT_KEY_PLAYER', 5);
define('PLAYERMAP_FAVRPG_SORT_KEY_MASTER', 6);
define('PLAYERMAP_FAVRPG_SORT_KEY_SINCE', 7);
define('PLAYERMAP_FAVRPG_SORT_KEY_OWNER', 8);
define('PLAYERMAP_FAVRPG_SORT_KEY_DESCRIPTION', 9);
define('PLAYERMAP_FAVRPG_SORT_KEY_POSTTIME', 10);

define('PLAYERMAP_FAVRPG_SORT_KEY_DEFAULT', PLAYERMAP_FAVRPG_SORT_KEY_FAVRPG_ID);

/**
 * Playermap_FavrpgFilterForm
**/
class Playermap_FavrpgFilterForm extends Playermap_AbstractFilterForm
{
    public /*** string[] ***/ $mSortKeys = array(
 	   PLAYERMAP_FAVRPG_SORT_KEY_FAVRPG_ID => 'favrpg_id',
 	   PLAYERMAP_FAVRPG_SORT_KEY_RPG_ID => 'rpg_id',
 	   PLAYERMAP_FAVRPG_SORT_KEY_UID => 'uid',
 	   PLAYERMAP_FAVRPG_SORT_KEY_RATING => 'rating',
 	   PLAYERMAP_FAVRPG_SORT_KEY_PLAYER => 'player',
 	   PLAYERMAP_FAVRPG_SORT_KEY_MASTER => 'master',
 	   PLAYERMAP_FAVRPG_SORT_KEY_SINCE => 'since',
 	   PLAYERMAP_FAVRPG_SORT_KEY_OWNER => 'owner',
 	   PLAYERMAP_FAVRPG_SORT_KEY_DESCRIPTION => 'description',
 	   PLAYERMAP_FAVRPG_SORT_KEY_POSTTIME => 'posttime',

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
        return PLAYERMAP_FAVRPG_SORT_KEY_DEFAULT;
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
    
		if (($value = $root->mContext->mRequest->getRequest('favrpg_id')) !== null) {
			$this->mNavi->addExtra('favrpg_id', $value);
			$this->_mCriteria->add(new Criteria('favrpg_id', $value));
		}
		if (($value = $root->mContext->mRequest->getRequest('rpg_id')) !== null) {
			$this->mNavi->addExtra('rpg_id', $value);
			$this->_mCriteria->add(new Criteria('rpg_id', $value));
		}
		if (($value = $root->mContext->mRequest->getRequest('uid')) !== null) {
			$this->mNavi->addExtra('uid', $value);
			$this->_mCriteria->add(new Criteria('uid', $value));
		}
		if (($value = $root->mContext->mRequest->getRequest('rating')) !== null) {
			$this->mNavi->addExtra('rating', $value);
			$this->_mCriteria->add(new Criteria('rating', $value));
		}
		if (($value = $root->mContext->mRequest->getRequest('player')) !== null) {
			$this->mNavi->addExtra('player', $value);
			$this->_mCriteria->add(new Criteria('player', $value));
		}
		if (($value = $root->mContext->mRequest->getRequest('master')) !== null) {
			$this->mNavi->addExtra('master', $value);
			$this->_mCriteria->add(new Criteria('master', $value));
		}
		if (($value = $root->mContext->mRequest->getRequest('since')) !== null) {
			$this->mNavi->addExtra('since', $value);
			$this->_mCriteria->add(new Criteria('since', $value));
		}
		if (($value = $root->mContext->mRequest->getRequest('owner')) !== null) {
			$this->mNavi->addExtra('owner', $value);
			$this->_mCriteria->add(new Criteria('owner', $value));
		}
		if (($value = $root->mContext->mRequest->getRequest('description')) !== null) {
			$this->mNavi->addExtra('description', $value);
			$this->_mCriteria->add(new Criteria('description', $value));
		}
		if (($value = $root->mContext->mRequest->getRequest('posttime')) !== null) {
			$this->mNavi->addExtra('posttime', $value);
			$this->_mCriteria->add(new Criteria('posttime', $value));
		}

    
        $this->_mCriteria->addSort($this->getSort(), $this->getOrder());
    }
}

?>
