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

define('RPGLINK_UPDATE_SORT_KEY_UPDATE_ID', 1);
define('RPGLINK_UPDATE_SORT_KEY_TITLE', 2);
define('RPGLINK_UPDATE_SORT_KEY_LINK_ID', 3);
define('RPGLINK_UPDATE_SORT_KEY_URL', 4);
define('RPGLINK_UPDATE_SORT_KEY_UPDATE_TIME', 5);
define('RPGLINK_UPDATE_SORT_KEY_DESCRIPTION', 6);
define('RPGLINK_UPDATE_SORT_KEY_POSTTIME', 7);

define('RPGLINK_UPDATE_SORT_KEY_DEFAULT', RPGLINK_UPDATE_SORT_KEY_UPDATE_ID);

/**
 * Rpglink_UpdateFilterForm
**/
class Rpglink_UpdateFilterForm extends Rpglink_AbstractFilterForm
{
    public /*** string[] ***/ $mSortKeys = array(
 	   RPGLINK_UPDATE_SORT_KEY_UPDATE_ID => 'update_id',
 	   RPGLINK_UPDATE_SORT_KEY_TITLE => 'title',
 	   RPGLINK_UPDATE_SORT_KEY_LINK_ID => 'link_id',
 	   RPGLINK_UPDATE_SORT_KEY_URL => 'url',
 	   RPGLINK_UPDATE_SORT_KEY_UPDATE_TIME => 'update_time',
 	   RPGLINK_UPDATE_SORT_KEY_DESCRIPTION => 'description',
 	   RPGLINK_UPDATE_SORT_KEY_POSTTIME => 'posttime',

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
        return RPGLINK_UPDATE_SORT_KEY_DEFAULT;
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
    
		if (($value = $root->mContext->mRequest->getRequest('update_id')) !== null) {
			$this->mNavi->addExtra('update_id', $value);
			$this->_mCriteria->add(new Criteria('update_id', $value));
		}
		if (($value = $root->mContext->mRequest->getRequest('title')) !== null) {
			$this->mNavi->addExtra('title', $value);
			$this->_mCriteria->add(new Criteria('title', $value));
		}
		if (($value = $root->mContext->mRequest->getRequest('link_id')) !== null) {
			$this->mNavi->addExtra('link_id', $value);
			$this->_mCriteria->add(new Criteria('link_id', $value));
		}
		if (($value = $root->mContext->mRequest->getRequest('url')) !== null) {
			$this->mNavi->addExtra('url', $value);
			$this->_mCriteria->add(new Criteria('url', $value));
		}
		if (($value = $root->mContext->mRequest->getRequest('update_time')) !== null) {
			$this->mNavi->addExtra('update_time', $value);
			$this->_mCriteria->add(new Criteria('update_time', $value));
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
