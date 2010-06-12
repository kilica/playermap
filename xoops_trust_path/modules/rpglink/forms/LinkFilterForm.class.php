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

define('RPGLINK_LINK_SORT_KEY_LINK_ID', 1);
define('RPGLINK_LINK_SORT_KEY_TITLE', 2);
define('RPGLINK_LINK_SORT_KEY_UID', 3);
define('RPGLINK_LINK_SORT_KEY_URL', 4);
define('RPGLINK_LINK_SORT_KEY_BANNER', 5);
define('RPGLINK_LINK_SORT_KEY_RSS', 6);
define('RPGLINK_LINK_SORT_KEY_PREF_ID', 7);
define('RPGLINK_LINK_SORT_KEY_DESCRIPTION', 8);
define('RPGLINK_LINK_SORT_KEY_POSTTIME', 9);

define('RPGLINK_LINK_SORT_KEY_DEFAULT', RPGLINK_LINK_SORT_KEY_LINK_ID);

/**
 * Rpglink_LinkFilterForm
**/
class Rpglink_LinkFilterForm extends Rpglink_AbstractFilterForm
{
    public /*** string[] ***/ $mSortKeys = array(
 	   RPGLINK_LINK_SORT_KEY_LINK_ID => 'link_id',
 	   RPGLINK_LINK_SORT_KEY_TITLE => 'title',
 	   RPGLINK_LINK_SORT_KEY_UID => 'uid',
 	   RPGLINK_LINK_SORT_KEY_URL => 'url',
 	   RPGLINK_LINK_SORT_KEY_BANNER => 'banner',
 	   RPGLINK_LINK_SORT_KEY_RSS => 'rss',
 	   RPGLINK_LINK_SORT_KEY_PREF_ID => 'pref_id',
 	   RPGLINK_LINK_SORT_KEY_DESCRIPTION => 'description',
 	   RPGLINK_LINK_SORT_KEY_POSTTIME => 'posttime',

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
        return RPGLINK_LINK_SORT_KEY_DEFAULT;
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
    
		if (($value = $root->mContext->mRequest->getRequest('link_id')) !== null) {
			$this->mNavi->addExtra('link_id', $value);
			$this->_mCriteria->add(new Criteria('link_id', $value));
		}
		if (($value = $root->mContext->mRequest->getRequest('title')) !== null) {
			$this->mNavi->addExtra('title', $value);
			$this->_mCriteria->add(new Criteria('title', $value));
		}
		if (($value = $root->mContext->mRequest->getRequest('uid')) !== null) {
			$this->mNavi->addExtra('uid', $value);
			$this->_mCriteria->add(new Criteria('uid', $value));
		}
		if (($value = $root->mContext->mRequest->getRequest('url')) !== null) {
			$this->mNavi->addExtra('url', $value);
			$this->_mCriteria->add(new Criteria('url', $value));
		}
		if (($value = $root->mContext->mRequest->getRequest('banner')) !== null) {
			$this->mNavi->addExtra('banner', $value);
			$this->_mCriteria->add(new Criteria('banner', $value));
		}
		if (($value = $root->mContext->mRequest->getRequest('rss')) !== null) {
			$this->mNavi->addExtra('rss', $value);
			$this->_mCriteria->add(new Criteria('rss', $value));
		}
		if (($value = $root->mContext->mRequest->getRequest('pref_id')) !== null) {
			$this->mNavi->addExtra('pref_id', $value);
			$this->_mCriteria->add(new Criteria('pref_id', $value));
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
