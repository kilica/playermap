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

define('PLAYERMAP_CONV_SORT_KEY_CONV_ID', 1);
define('PLAYERMAP_CONV_SORT_KEY_TITLE', 2);
define('PLAYERMAP_CONV_SORT_KEY_UID', 3);
define('PLAYERMAP_CONV_SORT_KEY_GROUP_ID', 4);
define('PLAYERMAP_CONV_SORT_KEY_PREF_ID', 5);
define('PLAYERMAP_CONV_SORT_KEY_SITE', 6);
define('PLAYERMAP_CONV_SORT_KEY_ADDRESS', 7);
define('PLAYERMAP_CONV_SORT_KEY_CV', 8);
define('PLAYERMAP_CONV_SORT_KEY_STARTTIME', 9);
define('PLAYERMAP_CONV_SORT_KEY_ENDTIME', 10);
define('PLAYERMAP_CONV_SORT_KEY_BOOKING', 11);
define('PLAYERMAP_CONV_SORT_KEY_FEE', 12);
define('PLAYERMAP_CONV_SORT_KEY_CAPACITY', 13);
define('PLAYERMAP_CONV_SORT_KEY_URL', 14);
define('PLAYERMAP_CONV_SORT_KEY_DESCRIPTION', 15);
define('PLAYERMAP_CONV_SORT_KEY_POSTTIME', 16);

define('PLAYERMAP_CONV_SORT_KEY_DEFAULT', PLAYERMAP_CONV_SORT_KEY_CONV_ID);

/**
 * Playermap_ConvFilterForm
**/
class Playermap_ConvFilterForm extends Playermap_AbstractFilterForm
{
    public /*** string[] ***/ $mSortKeys = array(
 	   PLAYERMAP_CONV_SORT_KEY_CONV_ID => 'conv_id',
 	   PLAYERMAP_CONV_SORT_KEY_TITLE => 'title',
 	   PLAYERMAP_CONV_SORT_KEY_UID => 'uid',
 	   PLAYERMAP_CONV_SORT_KEY_GROUP_ID => 'group_id',
 	   PLAYERMAP_CONV_SORT_KEY_PREF_ID => 'pref_id',
 	   PLAYERMAP_CONV_SORT_KEY_SITE => 'site',
 	   PLAYERMAP_CONV_SORT_KEY_ADDRESS => 'address',
 	   PLAYERMAP_CONV_SORT_KEY_CV => 'cv',
 	   PLAYERMAP_CONV_SORT_KEY_STARTTIME => 'starttime',
 	   PLAYERMAP_CONV_SORT_KEY_ENDTIME => 'endtime',
 	   PLAYERMAP_CONV_SORT_KEY_BOOKING => 'booking',
 	   PLAYERMAP_CONV_SORT_KEY_FEE => 'fee',
 	   PLAYERMAP_CONV_SORT_KEY_CAPACITY => 'capacity',
 	   PLAYERMAP_CONV_SORT_KEY_URL => 'url',
 	   PLAYERMAP_CONV_SORT_KEY_DESCRIPTION => 'description',
 	   PLAYERMAP_CONV_SORT_KEY_POSTTIME => 'posttime',

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
        return PLAYERMAP_CONV_SORT_KEY_DEFAULT;
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
    
		if (($value = $root->mContext->mRequest->getRequest('conv_id')) !== null) {
			$this->mNavi->addExtra('conv_id', $value);
			$this->_mCriteria->add(new Criteria('conv_id', $value));
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
		if (($value = $root->mContext->mRequest->getRequest('pref_id')) !== null) {
			$this->mNavi->addExtra('pref_id', $value);
			$this->_mCriteria->add(new Criteria('pref_id', $value));
		}
		if (($value = $root->mContext->mRequest->getRequest('site')) !== null) {
			$this->mNavi->addExtra('site', $value);
			$this->_mCriteria->add(new Criteria('site', $value));
		}
		if (($value = $root->mContext->mRequest->getRequest('address')) !== null) {
			$this->mNavi->addExtra('address', $value);
			$this->_mCriteria->add(new Criteria('address', $value));
		}
		if (($value = $root->mContext->mRequest->getRequest('cv')) !== null) {
			$this->mNavi->addExtra('cv', $value);
			$this->_mCriteria->add(new Criteria('cv', $value));
		}
		if (($value = $root->mContext->mRequest->getRequest('starttime')) !== null) {
			$this->mNavi->addExtra('starttime', $value);
			$this->_mCriteria->add(new Criteria('starttime', $value));
		}
		if (($value = $root->mContext->mRequest->getRequest('endtime')) !== null) {
			$this->mNavi->addExtra('endtime', $value);
			$this->_mCriteria->add(new Criteria('endtime', $value));
		}
		if (($value = $root->mContext->mRequest->getRequest('booking')) !== null) {
			$this->mNavi->addExtra('booking', $value);
			$this->_mCriteria->add(new Criteria('booking', $value));
		}
		if (($value = $root->mContext->mRequest->getRequest('fee')) !== null) {
			$this->mNavi->addExtra('fee', $value);
			$this->_mCriteria->add(new Criteria('fee', $value));
		}
		if (($value = $root->mContext->mRequest->getRequest('capacity')) !== null) {
			$this->mNavi->addExtra('capacity', $value);
			$this->_mCriteria->add(new Criteria('capacity', $value));
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
