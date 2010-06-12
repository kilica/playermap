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

define('TRPG_BOOK_SORT_KEY_BOOK_ID', 1);
define('TRPG_BOOK_SORT_KEY_TITLE', 2);
define('TRPG_BOOK_SORT_KEY_RPG_ID', 3);
define('TRPG_BOOK_SORT_KEY_VERSION', 4);
define('TRPG_BOOK_SORT_KEY_BTYPE', 5);
define('TRPG_BOOK_SORT_KEY_PUB_ID', 6);
define('TRPG_BOOK_SORT_KEY_ISBN', 7);
define('TRPG_BOOK_SORT_KEY_ISBN13', 8);
define('TRPG_BOOK_SORT_KEY_PUBYEAR', 9);
define('TRPG_BOOK_SORT_KEY_PRICE', 10);
define('TRPG_BOOK_SORT_KEY_CURRENCY', 11);
define('TRPG_BOOK_SORT_KEY_URL', 12);
define('TRPG_BOOK_SORT_KEY_DESCRIPTION', 13);
define('TRPG_BOOK_SORT_KEY_POSTTIME', 14);

define('TRPG_BOOK_SORT_KEY_DEFAULT', TRPG_BOOK_SORT_KEY_BOOK_ID);

/**
 * Trpg_BookFilterForm
**/
class Trpg_BookFilterForm extends Trpg_AbstractFilterForm
{
    public /*** string[] ***/ $mSortKeys = array(
 	   TRPG_BOOK_SORT_KEY_BOOK_ID => 'book_id',
 	   TRPG_BOOK_SORT_KEY_TITLE => 'title',
 	   TRPG_BOOK_SORT_KEY_RPG_ID => 'rpg_id',
 	   TRPG_BOOK_SORT_KEY_VERSION => 'version',
 	   TRPG_BOOK_SORT_KEY_BTYPE => 'btype',
 	   TRPG_BOOK_SORT_KEY_PUB_ID => 'pub_id',
 	   TRPG_BOOK_SORT_KEY_ISBN => 'isbn',
 	   TRPG_BOOK_SORT_KEY_ISBN13 => 'isbn13',
 	   TRPG_BOOK_SORT_KEY_PUBYEAR => 'pubyear',
 	   TRPG_BOOK_SORT_KEY_PRICE => 'price',
 	   TRPG_BOOK_SORT_KEY_CURRENCY => 'currency',
 	   TRPG_BOOK_SORT_KEY_URL => 'url',
 	   TRPG_BOOK_SORT_KEY_DESCRIPTION => 'description',
 	   TRPG_BOOK_SORT_KEY_POSTTIME => 'posttime',

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
        return TRPG_BOOK_SORT_KEY_DEFAULT;
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
    
		if (($value = $root->mContext->mRequest->getRequest('book_id')) !== null) {
			$this->mNavi->addExtra('book_id', $value);
			$this->_mCriteria->add(new Criteria('book_id', $value));
		}
		if (($value = $root->mContext->mRequest->getRequest('title')) !== null) {
			$this->mNavi->addExtra('title', $value);
			$this->_mCriteria->add(new Criteria('title', $value));
		}
		if (($value = $root->mContext->mRequest->getRequest('rpg_id')) !== null) {
			$this->mNavi->addExtra('rpg_id', $value);
			$this->_mCriteria->add(new Criteria('rpg_id', $value));
		}
		if (($value = $root->mContext->mRequest->getRequest('version')) !== null) {
			$this->mNavi->addExtra('version', $value);
			$this->_mCriteria->add(new Criteria('version', $value));
		}
		if (($value = $root->mContext->mRequest->getRequest('btype')) !== null) {
			$this->mNavi->addExtra('btype', $value);
			$this->_mCriteria->add(new Criteria('btype', $value));
		}
		if (($value = $root->mContext->mRequest->getRequest('pub_id')) !== null) {
			$this->mNavi->addExtra('pub_id', $value);
			$this->_mCriteria->add(new Criteria('pub_id', $value));
		}
		if (($value = $root->mContext->mRequest->getRequest('isbn')) !== null) {
			$this->mNavi->addExtra('isbn', $value);
			$this->_mCriteria->add(new Criteria('isbn', $value));
		}
		if (($value = $root->mContext->mRequest->getRequest('isbn13')) !== null) {
			$this->mNavi->addExtra('isbn13', $value);
			$this->_mCriteria->add(new Criteria('isbn13', $value));
		}
		if (($value = $root->mContext->mRequest->getRequest('pubyear')) !== null) {
			$this->mNavi->addExtra('pubyear', $value);
			$this->_mCriteria->add(new Criteria('pubyear', $value));
		}
		if (($value = $root->mContext->mRequest->getRequest('price')) !== null) {
			$this->mNavi->addExtra('price', $value);
			$this->_mCriteria->add(new Criteria('price', $value));
		}
		if (($value = $root->mContext->mRequest->getRequest('currency')) !== null) {
			$this->mNavi->addExtra('currency', $value);
			$this->_mCriteria->add(new Criteria('currency', $value));
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
