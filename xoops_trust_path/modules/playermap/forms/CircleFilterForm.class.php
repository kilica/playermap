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

define('PLAYERMAP_CIRCLE_SORT_KEY_GROUP_ID', 1);
define('PLAYERMAP_CIRCLE_SORT_KEY_ADDRESS', 2);
define('PLAYERMAP_CIRCLE_SORT_KEY_PREF_ID', 3);
define('PLAYERMAP_CIRCLE_SORT_KEY_GRP', 4);
define('PLAYERMAP_CIRCLE_SORT_KEY_SUN', 5);
define('PLAYERMAP_CIRCLE_SORT_KEY_MON', 6);
define('PLAYERMAP_CIRCLE_SORT_KEY_TUE', 7);
define('PLAYERMAP_CIRCLE_SORT_KEY_WED', 8);
define('PLAYERMAP_CIRCLE_SORT_KEY_THU', 9);
define('PLAYERMAP_CIRCLE_SORT_KEY_FRI', 10);
define('PLAYERMAP_CIRCLE_SORT_KEY_SAT', 11);
define('PLAYERMAP_CIRCLE_SORT_KEY_HOL', 12);
define('PLAYERMAP_CIRCLE_SORT_KEY_PBN', 13);
define('PLAYERMAP_CIRCLE_SORT_KEY_POSTTIME', 14);

define('PLAYERMAP_CIRCLE_SORT_KEY_DEFAULT', PLAYERMAP_CIRCLE_SORT_KEY_GROUP_ID);

/**
 * Playermap_CircleFilterForm
**/
class Playermap_CircleFilterForm extends Playermap_AbstractFilterForm
{
    public /*** string[] ***/ $mSortKeys = array(
 	   PLAYERMAP_CIRCLE_SORT_KEY_GROUP_ID => 'group_id',
 	   PLAYERMAP_CIRCLE_SORT_KEY_ADDRESS => 'address',
 	   PLAYERMAP_CIRCLE_SORT_KEY_PREF_ID => 'pref_id',
 	   PLAYERMAP_CIRCLE_SORT_KEY_GRP => 'grp',
 	   PLAYERMAP_CIRCLE_SORT_KEY_SUN => 'sun',
 	   PLAYERMAP_CIRCLE_SORT_KEY_MON => 'mon',
 	   PLAYERMAP_CIRCLE_SORT_KEY_TUE => 'tue',
 	   PLAYERMAP_CIRCLE_SORT_KEY_WED => 'wed',
 	   PLAYERMAP_CIRCLE_SORT_KEY_THU => 'thu',
 	   PLAYERMAP_CIRCLE_SORT_KEY_FRI => 'fri',
 	   PLAYERMAP_CIRCLE_SORT_KEY_SAT => 'sat',
 	   PLAYERMAP_CIRCLE_SORT_KEY_HOL => 'hol',
 	   PLAYERMAP_CIRCLE_SORT_KEY_PBN => 'pbn',
 	   PLAYERMAP_CIRCLE_SORT_KEY_POSTTIME => 'posttime',

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
        return PLAYERMAP_CIRCLE_SORT_KEY_DEFAULT;
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
		if (($value = $root->mContext->mRequest->getRequest('address')) !== null) {
			$this->mNavi->addExtra('address', $value);
			$this->_mCriteria->add(new Criteria('address', $value));
		}
		if (($value = $root->mContext->mRequest->getRequest('pref_id')) !== null) {
			$this->mNavi->addExtra('pref_id', $value);
			$this->_mCriteria->add(new Criteria('pref_id', $value));
		}
		if (($value = $root->mContext->mRequest->getRequest('grp')) !== null) {
			$this->mNavi->addExtra('grp', $value);
			$this->_mCriteria->add(new Criteria('grp', $value));
		}
		if (($value = $root->mContext->mRequest->getRequest('sun')) !== null) {
			$this->mNavi->addExtra('sun', $value);
			$this->_mCriteria->add(new Criteria('sun', $value));
		}
		if (($value = $root->mContext->mRequest->getRequest('mon')) !== null) {
			$this->mNavi->addExtra('mon', $value);
			$this->_mCriteria->add(new Criteria('mon', $value));
		}
		if (($value = $root->mContext->mRequest->getRequest('tue')) !== null) {
			$this->mNavi->addExtra('tue', $value);
			$this->_mCriteria->add(new Criteria('tue', $value));
		}
		if (($value = $root->mContext->mRequest->getRequest('wed')) !== null) {
			$this->mNavi->addExtra('wed', $value);
			$this->_mCriteria->add(new Criteria('wed', $value));
		}
		if (($value = $root->mContext->mRequest->getRequest('thu')) !== null) {
			$this->mNavi->addExtra('thu', $value);
			$this->_mCriteria->add(new Criteria('thu', $value));
		}
		if (($value = $root->mContext->mRequest->getRequest('fri')) !== null) {
			$this->mNavi->addExtra('fri', $value);
			$this->_mCriteria->add(new Criteria('fri', $value));
		}
		if (($value = $root->mContext->mRequest->getRequest('sat')) !== null) {
			$this->mNavi->addExtra('sat', $value);
			$this->_mCriteria->add(new Criteria('sat', $value));
		}
		if (($value = $root->mContext->mRequest->getRequest('hol')) !== null) {
			$this->mNavi->addExtra('hol', $value);
			$this->_mCriteria->add(new Criteria('hol', $value));
		}
		if (($value = $root->mContext->mRequest->getRequest('pbn')) !== null) {
			$this->mNavi->addExtra('pbn', $value);
			$this->_mCriteria->add(new Criteria('pbn', $value));
		}
		if (($value = $root->mContext->mRequest->getRequest('posttime')) !== null) {
			$this->mNavi->addExtra('posttime', $value);
			$this->_mCriteria->add(new Criteria('posttime', $value));
		}

    
        $this->_mCriteria->addSort($this->getSort(), $this->getOrder());
    }
}

?>
