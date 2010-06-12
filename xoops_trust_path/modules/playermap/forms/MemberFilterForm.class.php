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

define('PLAYERMAP_MEMBER_SORT_KEY_MEMBER_ID', 1);
define('PLAYERMAP_MEMBER_SORT_KEY_GROUP_ID', 2);
define('PLAYERMAP_MEMBER_SORT_KEY_UID', 3);
define('PLAYERMAP_MEMBER_SORT_KEY_STATUS', 4);
define('PLAYERMAP_MEMBER_SORT_KEY_SINCE', 5);
define('PLAYERMAP_MEMBER_SORT_KEY_RANK', 6);
define('PLAYERMAP_MEMBER_SORT_KEY_POSTTIME', 7);

define('PLAYERMAP_MEMBER_SORT_KEY_DEFAULT', PLAYERMAP_MEMBER_SORT_KEY_MEMBER_ID);

/**
 * Playermap_MemberFilterForm
**/
class Playermap_MemberFilterForm extends Playermap_AbstractFilterForm
{
    public /*** string[] ***/ $mSortKeys = array(
 	   PLAYERMAP_MEMBER_SORT_KEY_MEMBER_ID => 'member_id',
 	   PLAYERMAP_MEMBER_SORT_KEY_GROUP_ID => 'group_id',
 	   PLAYERMAP_MEMBER_SORT_KEY_UID => 'uid',
 	   PLAYERMAP_MEMBER_SORT_KEY_STATUS => 'status',
 	   PLAYERMAP_MEMBER_SORT_KEY_SINCE => 'since',
 	   PLAYERMAP_MEMBER_SORT_KEY_RANK => 'rank',
 	   PLAYERMAP_MEMBER_SORT_KEY_POSTTIME => 'posttime',

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
        return PLAYERMAP_MEMBER_SORT_KEY_DEFAULT;
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
    
		if (($value = $root->mContext->mRequest->getRequest('member_id')) !== null) {
			$this->mNavi->addExtra('member_id', $value);
			$this->_mCriteria->add(new Criteria('member_id', $value));
		}
		if (($value = $root->mContext->mRequest->getRequest('group_id')) !== null) {
			$this->mNavi->addExtra('group_id', $value);
			$this->_mCriteria->add(new Criteria('group_id', $value));
		}
		if (($value = $root->mContext->mRequest->getRequest('uid')) !== null) {
			$this->mNavi->addExtra('uid', $value);
			$this->_mCriteria->add(new Criteria('uid', $value));
		}
		if (($value = $root->mContext->mRequest->getRequest('status')) !== null) {
			$this->mNavi->addExtra('status', $value);
			$this->_mCriteria->add(new Criteria('status', $value));
		}
		if (($value = $root->mContext->mRequest->getRequest('since')) !== null) {
			$this->mNavi->addExtra('since', $value);
			$this->_mCriteria->add(new Criteria('since', $value));
		}
		if (($value = $root->mContext->mRequest->getRequest('rank')) !== null) {
			$this->mNavi->addExtra('rank', $value);
			$this->_mCriteria->add(new Criteria('rank', $value));
		}
		if (($value = $root->mContext->mRequest->getRequest('posttime')) !== null) {
			$this->mNavi->addExtra('posttime', $value);
			$this->_mCriteria->add(new Criteria('posttime', $value));
		}

    
        $this->_mCriteria->addSort($this->getSort(), $this->getOrder());
    }
}

?>
