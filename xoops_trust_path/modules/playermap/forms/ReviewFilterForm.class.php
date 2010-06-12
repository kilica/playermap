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

define('PLAYERMAP_REVIEW_SORT_KEY_REVIEW_ID', 1);
define('PLAYERMAP_REVIEW_SORT_KEY_BOOK_ID', 2);
define('PLAYERMAP_REVIEW_SORT_KEY_UID', 3);
define('PLAYERMAP_REVIEW_SORT_KEY_RATING', 4);
define('PLAYERMAP_REVIEW_SORT_KEY_IMPORTANCE', 5);
define('PLAYERMAP_REVIEW_SORT_KEY_OWNER', 6);
define('PLAYERMAP_REVIEW_SORT_KEY_DESCRIPTION', 7);
define('PLAYERMAP_REVIEW_SORT_KEY_POSTTIME', 8);

define('PLAYERMAP_REVIEW_SORT_KEY_DEFAULT', PLAYERMAP_REVIEW_SORT_KEY_REVIEW_ID);

/**
 * Playermap_ReviewFilterForm
**/
class Playermap_ReviewFilterForm extends Playermap_AbstractFilterForm
{
    public /*** string[] ***/ $mSortKeys = array(
 	   PLAYERMAP_REVIEW_SORT_KEY_REVIEW_ID => 'review_id',
 	   PLAYERMAP_REVIEW_SORT_KEY_BOOK_ID => 'book_id',
 	   PLAYERMAP_REVIEW_SORT_KEY_UID => 'uid',
 	   PLAYERMAP_REVIEW_SORT_KEY_RATING => 'rating',
 	   PLAYERMAP_REVIEW_SORT_KEY_IMPORTANCE => 'importance',
 	   PLAYERMAP_REVIEW_SORT_KEY_OWNER => 'owner',
 	   PLAYERMAP_REVIEW_SORT_KEY_DESCRIPTION => 'description',
 	   PLAYERMAP_REVIEW_SORT_KEY_POSTTIME => 'posttime',

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
        return PLAYERMAP_REVIEW_SORT_KEY_DEFAULT;
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
    
		if (($value = $root->mContext->mRequest->getRequest('review_id')) !== null) {
			$this->mNavi->addExtra('review_id', $value);
			$this->_mCriteria->add(new Criteria('review_id', $value));
		}
		if (($value = $root->mContext->mRequest->getRequest('book_id')) !== null) {
			$this->mNavi->addExtra('book_id', $value);
			$this->_mCriteria->add(new Criteria('book_id', $value));
		}
		if (($value = $root->mContext->mRequest->getRequest('uid')) !== null) {
			$this->mNavi->addExtra('uid', $value);
			$this->_mCriteria->add(new Criteria('uid', $value));
		}
		if (($value = $root->mContext->mRequest->getRequest('rating')) !== null) {
			$this->mNavi->addExtra('rating', $value);
			$this->_mCriteria->add(new Criteria('rating', $value));
		}
		if (($value = $root->mContext->mRequest->getRequest('importance')) !== null) {
			$this->mNavi->addExtra('importance', $value);
			$this->_mCriteria->add(new Criteria('importance', $value));
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
