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

define('PLAYERMAP_RECRUIT_SORT_KEY_RECRUIT_ID', 1);
define('PLAYERMAP_RECRUIT_SORT_KEY_TITLE', 2);
define('PLAYERMAP_RECRUIT_SORT_KEY_UID', 3);
define('PLAYERMAP_RECRUIT_SORT_KEY_GROUP_ID', 4);
define('PLAYERMAP_RECRUIT_SORT_KEY_ENDTIME', 5);
define('PLAYERMAP_RECRUIT_SORT_KEY_DESCRIPTION', 6);
define('PLAYERMAP_RECRUIT_SORT_KEY_POSTTIME', 7);

define('PLAYERMAP_RECRUIT_SORT_KEY_DEFAULT', PLAYERMAP_RECRUIT_SORT_KEY_RECRUIT_ID);

/**
 * Playermap_RecruitFilterForm
**/
class Playermap_RecruitFilterForm extends Playermap_AbstractFilterForm
{
    public /*** string[] ***/ $mSortKeys = array(
 	   PLAYERMAP_RECRUIT_SORT_KEY_RECRUIT_ID => 'recruit_id',
 	   PLAYERMAP_RECRUIT_SORT_KEY_TITLE => 'title',
 	   PLAYERMAP_RECRUIT_SORT_KEY_UID => 'uid',
 	   PLAYERMAP_RECRUIT_SORT_KEY_GROUP_ID => 'group_id',
 	   PLAYERMAP_RECRUIT_SORT_KEY_ENDTIME => 'endtime',
 	   PLAYERMAP_RECRUIT_SORT_KEY_DESCRIPTION => 'description',
 	   PLAYERMAP_RECRUIT_SORT_KEY_POSTTIME => 'posttime',

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
        return PLAYERMAP_RECRUIT_SORT_KEY_DEFAULT;
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
    
		if (($value = $root->mContext->mRequest->getRequest('recruit_id')) !== null) {
			$this->mNavi->addExtra('recruit_id', $value);
			$this->_mCriteria->add(new Criteria('recruit_id', $value));
		}
		if (($value = $root->mContext->mRequest->getRequest('title')) !== null) {
			$this->mNavi->addExtra('title', $value);
			$this->_mCriteria->add(new Criteria('title', $value));
		}
		if (($value = $root->mContext->mRequest->getRequest('uid')) !== null) {
			$this->mNavi->addExtra('uid', $value);
			$this->_mCriteria->add(new Criteria('uid', $value));
		}
		if (($value = $root->mContext->mRequest->getRequest('group_id')) !== null) {
			$this->mNavi->addExtra('group_id', $value);
			$this->_mCriteria->add(new Criteria('group_id', $value));
		}
		if (($value = $root->mContext->mRequest->getRequest('endtime')) !== null) {
			$this->mNavi->addExtra('endtime', $value);
			$this->_mCriteria->add(new Criteria('endtime', $value));
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
