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

define('PLAYERMAP_ENTRY_SORT_KEY_ENTRY_ID', 1);
define('PLAYERMAP_ENTRY_SORT_KEY_LOG_ID', 2);
define('PLAYERMAP_ENTRY_SORT_KEY_UID', 3);
define('PLAYERMAP_ENTRY_SORT_KEY_ROLE', 4);
define('PLAYERMAP_ENTRY_SORT_KEY_SCHEDULE', 5);
define('PLAYERMAP_ENTRY_SORT_KEY_DESCRIPTION', 6);
define('PLAYERMAP_ENTRY_SORT_KEY_COMMENT', 7);
define('PLAYERMAP_ENTRY_SORT_KEY_POSTTIME', 8);

define('PLAYERMAP_ENTRY_SORT_KEY_DEFAULT', PLAYERMAP_ENTRY_SORT_KEY_ENTRY_ID);

/**
 * Playermap_EntryFilterForm
**/
class Playermap_EntryFilterForm extends Playermap_AbstractFilterForm
{
    public /*** string[] ***/ $mSortKeys = array(
 	   PLAYERMAP_ENTRY_SORT_KEY_ENTRY_ID => 'entry_id',
 	   PLAYERMAP_ENTRY_SORT_KEY_LOG_ID => 'log_id',
 	   PLAYERMAP_ENTRY_SORT_KEY_UID => 'uid',
 	   PLAYERMAP_ENTRY_SORT_KEY_ROLE => 'role',
 	   PLAYERMAP_ENTRY_SORT_KEY_SCHEDULE => 'schedule',
 	   PLAYERMAP_ENTRY_SORT_KEY_DESCRIPTION => 'description',
 	   PLAYERMAP_ENTRY_SORT_KEY_COMMENT => 'comment',
 	   PLAYERMAP_ENTRY_SORT_KEY_POSTTIME => 'posttime',

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
        return PLAYERMAP_ENTRY_SORT_KEY_DEFAULT;
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
    
		if (($value = $root->mContext->mRequest->getRequest('entry_id')) !== null) {
			$this->mNavi->addExtra('entry_id', $value);
			$this->_mCriteria->add(new Criteria('entry_id', $value));
		}
		if (($value = $root->mContext->mRequest->getRequest('log_id')) !== null) {
			$this->mNavi->addExtra('log_id', $value);
			$this->_mCriteria->add(new Criteria('log_id', $value));
		}
		if (($value = $root->mContext->mRequest->getRequest('uid')) !== null) {
			$this->mNavi->addExtra('uid', $value);
			$this->_mCriteria->add(new Criteria('uid', $value));
		}
		if (($value = $root->mContext->mRequest->getRequest('role')) !== null) {
			$this->mNavi->addExtra('role', $value);
			$this->_mCriteria->add(new Criteria('role', $value));
		}
		if (($value = $root->mContext->mRequest->getRequest('schedule')) !== null) {
			$this->mNavi->addExtra('schedule', $value);
			$this->_mCriteria->add(new Criteria('schedule', $value));
		}
		if (($value = $root->mContext->mRequest->getRequest('description')) !== null) {
			$this->mNavi->addExtra('description', $value);
			$this->_mCriteria->add(new Criteria('description', $value));
		}
		if (($value = $root->mContext->mRequest->getRequest('comment')) !== null) {
			$this->mNavi->addExtra('comment', $value);
			$this->_mCriteria->add(new Criteria('comment', $value));
		}
		if (($value = $root->mContext->mRequest->getRequest('posttime')) !== null) {
			$this->mNavi->addExtra('posttime', $value);
			$this->_mCriteria->add(new Criteria('posttime', $value));
		}

    
        $this->_mCriteria->addSort($this->getSort(), $this->getOrder());
    }
}

?>
