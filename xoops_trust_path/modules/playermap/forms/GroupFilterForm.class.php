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

define('PLAYERMAP_GROUP_SORT_KEY_GROUP_ID', 1);
define('PLAYERMAP_GROUP_SORT_KEY_TITLE', 2);
define('PLAYERMAP_GROUP_SORT_KEY_URL', 3);
define('PLAYERMAP_GROUP_SORT_KEY_DESCRIPTION', 4);
define('PLAYERMAP_GROUP_SORT_KEY_POLICY', 5);
define('PLAYERMAP_GROUP_SORT_KEY_POSTTIME', 6);

define('PLAYERMAP_GROUP_SORT_KEY_DEFAULT', PLAYERMAP_GROUP_SORT_KEY_GROUP_ID);

/**
 * Playermap_GroupFilterForm
**/
class Playermap_GroupFilterForm extends Playermap_AbstractFilterForm
{
    public /*** string[] ***/ $mSortKeys = array(
 	   PLAYERMAP_GROUP_SORT_KEY_GROUP_ID => 'group_id',
 	   PLAYERMAP_GROUP_SORT_KEY_TITLE => 'title',
 	   PLAYERMAP_GROUP_SORT_KEY_URL => 'url',
 	   PLAYERMAP_GROUP_SORT_KEY_DESCRIPTION => 'description',
 	   PLAYERMAP_GROUP_SORT_KEY_POLICY => 'policy',
 	   PLAYERMAP_GROUP_SORT_KEY_POSTTIME => 'posttime',

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
        return PLAYERMAP_GROUP_SORT_KEY_DEFAULT;
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
    
		if (($value = $root->mContext->mRequest->getRequest('group_id')) !== null) {
			$this->mNavi->addExtra('group_id', $value);
			$this->_mCriteria->add(new Criteria('group_id', $value));
		}
		if (($value = $root->mContext->mRequest->getRequest('title')) !== null) {
			$this->mNavi->addExtra('title', $value);
			$this->_mCriteria->add(new Criteria('title', $value));
		}
		if (($value = $root->mContext->mRequest->getRequest('url')) !== null) {
			$this->mNavi->addExtra('url', $value);
			$this->_mCriteria->add(new Criteria('url', $value));
		}
		if (($value = $root->mContext->mRequest->getRequest('description')) !== null) {
			$this->mNavi->addExtra('description', $value);
			$this->_mCriteria->add(new Criteria('description', $value));
		}
		if (($value = $root->mContext->mRequest->getRequest('policy')) !== null) {
			$this->mNavi->addExtra('policy', $value);
			$this->_mCriteria->add(new Criteria('policy', $value));
		}
		if (($value = $root->mContext->mRequest->getRequest('posttime')) !== null) {
			$this->mNavi->addExtra('posttime', $value);
			$this->_mCriteria->add(new Criteria('posttime', $value));
		}

    
        $this->_mCriteria->addSort($this->getSort(), $this->getOrder());
    }
}

?>
