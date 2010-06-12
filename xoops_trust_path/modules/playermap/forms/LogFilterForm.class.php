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

define('PLAYERMAP_LOG_SORT_KEY_LOG_ID', 1);
define('PLAYERMAP_LOG_SORT_KEY_TITLE', 2);
define('PLAYERMAP_LOG_SORT_KEY_UID', 3);
define('PLAYERMAP_LOG_SORT_KEY_RPG_ID', 4);
define('PLAYERMAP_LOG_SORT_KEY_GROUP_ID', 5);
define('PLAYERMAP_LOG_SORT_KEY_CONV_ID', 6);
define('PLAYERMAP_LOG_SORT_KEY_SESSIONTIME', 7);
define('PLAYERMAP_LOG_SORT_KEY_SCHEDULETIME', 8);
define('PLAYERMAP_LOG_SORT_KEY_RECRUIT', 9);
define('PLAYERMAP_LOG_SORT_KEY_URL', 10);
define('PLAYERMAP_LOG_SORT_KEY_DESCRIPTION', 11);
define('PLAYERMAP_LOG_SORT_KEY_POSTTIME', 12);

define('PLAYERMAP_LOG_SORT_KEY_DEFAULT', PLAYERMAP_LOG_SORT_KEY_LOG_ID);

/**
 * Playermap_LogFilterForm
**/
class Playermap_LogFilterForm extends Playermap_AbstractFilterForm
{
    public /*** string[] ***/ $mSortKeys = array(
 	   PLAYERMAP_LOG_SORT_KEY_LOG_ID => 'log_id',
 	   PLAYERMAP_LOG_SORT_KEY_TITLE => 'title',
 	   PLAYERMAP_LOG_SORT_KEY_UID => 'uid',
 	   PLAYERMAP_LOG_SORT_KEY_RPG_ID => 'rpg_id',
 	   PLAYERMAP_LOG_SORT_KEY_GROUP_ID => 'group_id',
 	   PLAYERMAP_LOG_SORT_KEY_CONV_ID => 'conv_id',
 	   PLAYERMAP_LOG_SORT_KEY_SESSIONTIME => 'sessiontime',
 	   PLAYERMAP_LOG_SORT_KEY_SCHEDULETIME => 'scheduletime',
 	   PLAYERMAP_LOG_SORT_KEY_RECRUIT => 'recruit',
 	   PLAYERMAP_LOG_SORT_KEY_URL => 'url',
 	   PLAYERMAP_LOG_SORT_KEY_DESCRIPTION => 'description',
 	   PLAYERMAP_LOG_SORT_KEY_POSTTIME => 'posttime',

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
        return PLAYERMAP_LOG_SORT_KEY_DEFAULT;
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
    
		if (($value = $root->mContext->mRequest->getRequest('log_id')) !== null) {
			$this->mNavi->addExtra('log_id', $value);
			$this->_mCriteria->add(new Criteria('log_id', $value));
		}
		if (($value = $root->mContext->mRequest->getRequest('title')) !== null) {
			$this->mNavi->addExtra('title', $value);
			$this->_mCriteria->add(new Criteria('title', $value));
		}
		if (($value = $root->mContext->mRequest->getRequest('uid')) !== null) {
			$this->mNavi->addExtra('uid', $value);
			$this->_mCriteria->add(new Criteria('uid', $value));
		}
		if (($value = $root->mContext->mRequest->getRequest('rpg_id')) !== null) {
			$this->mNavi->addExtra('rpg_id', $value);
			$this->_mCriteria->add(new Criteria('rpg_id', $value));
		}
		if (($value = $root->mContext->mRequest->getRequest('group_id')) !== null) {
			$this->mNavi->addExtra('group_id', $value);
			$this->_mCriteria->add(new Criteria('group_id', $value));
		}
		if (($value = $root->mContext->mRequest->getRequest('conv_id')) !== null) {
			$this->mNavi->addExtra('conv_id', $value);
			$this->_mCriteria->add(new Criteria('conv_id', $value));
		}
		if (($value = $root->mContext->mRequest->getRequest('sessiontime')) !== null) {
			$this->mNavi->addExtra('sessiontime', $value);
			$this->_mCriteria->add(new Criteria('sessiontime', $value));
		}
		if (($value = $root->mContext->mRequest->getRequest('scheduletime')) !== null) {
			$this->mNavi->addExtra('scheduletime', $value);
			$this->_mCriteria->add(new Criteria('scheduletime', $value));
		}
		if (($value = $root->mContext->mRequest->getRequest('recruit')) !== null) {
			$this->mNavi->addExtra('recruit', $value);
			$this->_mCriteria->add(new Criteria('recruit', $value));
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
