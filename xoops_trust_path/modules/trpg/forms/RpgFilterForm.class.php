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

require_once TRPG_TRUST_PATH . '/class/AbstractFilterForm.class.php';

define('TRPG_RPG_SORT_KEY_RPG_ID', 1);
define('TRPG_RPG_SORT_KEY_TITLE', 2);
define('TRPG_RPG_SORT_KEY_KANA', 3);
define('TRPG_RPG_SORT_KEY_ABBR', 4);
define('TRPG_RPG_SORT_KEY_PUB_ID', 5);
define('TRPG_RPG_SORT_KEY_URL', 6);
define('TRPG_RPG_SORT_KEY_DESCRIPTION', 7);
define('TRPG_RPG_SORT_KEY_POSTTIME', 8);

define('TRPG_RPG_SORT_KEY_DEFAULT', TRPG_RPG_SORT_KEY_RPG_ID);

/**
 * Trpg_RpgFilterForm
**/
class Trpg_RpgFilterForm extends Trpg_AbstractFilterForm
{
    public /*** string[] ***/ $mSortKeys = array(
 	   TRPG_RPG_SORT_KEY_RPG_ID => 'rpg_id',
 	   TRPG_RPG_SORT_KEY_TITLE => 'title',
 	   TRPG_RPG_SORT_KEY_KANA => 'kana',
 	   TRPG_RPG_SORT_KEY_ABBR => 'abbr',
 	   TRPG_RPG_SORT_KEY_PUB_ID => 'pub_id',
 	   TRPG_RPG_SORT_KEY_URL => 'url',
 	   TRPG_RPG_SORT_KEY_DESCRIPTION => 'description',
 	   TRPG_RPG_SORT_KEY_POSTTIME => 'posttime',

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
        return TRPG_RPG_SORT_KEY_DEFAULT;
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
    
		if (($value = $root->mContext->mRequest->getRequest('rpg_id')) !== null) {
			$this->mNavi->addExtra('rpg_id', $value);
			$this->_mCriteria->add(new Criteria('rpg_id', $value));
		}
		if (($value = $root->mContext->mRequest->getRequest('title')) !== null) {
			$this->mNavi->addExtra('title', $value);
			$this->_mCriteria->add(new Criteria('title', $value));
		}
		if (($value = $root->mContext->mRequest->getRequest('kana')) !== null) {
			$this->mNavi->addExtra('kana', $value);
			$this->_mCriteria->add(new Criteria('kana', $value));
		}
		if (($value = $root->mContext->mRequest->getRequest('abbr')) !== null) {
			$this->mNavi->addExtra('abbr', $value);
			$this->_mCriteria->add(new Criteria('abbr', $value));
		}
		if (($value = $root->mContext->mRequest->getRequest('pub_id')) !== null) {
			$this->mNavi->addExtra('pub_id', $value);
			$this->_mCriteria->add(new Criteria('pub_id', $value));
		}
		if (($value = $root->mContext->mRequest->getRequest('url')) !== null) {
			$this->mNavi->addExtra('url', $value);
			$this->_mCriteria->add(new Criteria('url', $value));
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
