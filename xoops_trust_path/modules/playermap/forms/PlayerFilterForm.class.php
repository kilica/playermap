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

define('PLAYERMAP_PLAYER_SORT_KEY_UID', 1);
define('PLAYERMAP_PLAYER_SORT_KEY_NAME', 2);
define('PLAYERMAP_PLAYER_SORT_KEY_GENDER', 3);
define('PLAYERMAP_PLAYER_SORT_KEY_BIRTHYEAR', 4);
define('PLAYERMAP_PLAYER_SORT_KEY_STARTYEAR', 5);
define('PLAYERMAP_PLAYER_SORT_KEY_PREF_ID', 6);
define('PLAYERMAP_PLAYER_SORT_KEY_ADDRESS', 7);
define('PLAYERMAP_PLAYER_SORT_KEY_PL', 8);
define('PLAYERMAP_PLAYER_SORT_KEY_ROLE', 9);
define('PLAYERMAP_PLAYER_SORT_KEY_SUN', 10);
define('PLAYERMAP_PLAYER_SORT_KEY_MON', 11);
define('PLAYERMAP_PLAYER_SORT_KEY_TUE', 12);
define('PLAYERMAP_PLAYER_SORT_KEY_WED', 13);
define('PLAYERMAP_PLAYER_SORT_KEY_THU', 14);
define('PLAYERMAP_PLAYER_SORT_KEY_FRI', 15);
define('PLAYERMAP_PLAYER_SORT_KEY_SAT', 16);
define('PLAYERMAP_PLAYER_SORT_KEY_HOL', 17);
define('PLAYERMAP_PLAYER_SORT_KEY_PBN', 18);
define('PLAYERMAP_PLAYER_SORT_KEY_DESCRIPTION', 19);
define('PLAYERMAP_PLAYER_SORT_KEY_POSTTIME', 20);

define('PLAYERMAP_PLAYER_SORT_KEY_DEFAULT', PLAYERMAP_PLAYER_SORT_KEY_UID);

/**
 * Playermap_PlayerFilterForm
**/
class Playermap_PlayerFilterForm extends Playermap_AbstractFilterForm
{
    public /*** string[] ***/ $mSortKeys = array(
 	   PLAYERMAP_PLAYER_SORT_KEY_UID => 'uid',
 	   PLAYERMAP_PLAYER_SORT_KEY_NAME => 'name',
 	   PLAYERMAP_PLAYER_SORT_KEY_GENDER => 'gender',
 	   PLAYERMAP_PLAYER_SORT_KEY_BIRTHYEAR => 'birthyear',
 	   PLAYERMAP_PLAYER_SORT_KEY_STARTYEAR => 'startyear',
 	   PLAYERMAP_PLAYER_SORT_KEY_PREF_ID => 'pref_id',
 	   PLAYERMAP_PLAYER_SORT_KEY_ADDRESS => 'address',
 	   PLAYERMAP_PLAYER_SORT_KEY_PL => 'pl',
 	   PLAYERMAP_PLAYER_SORT_KEY_ROLE => 'role',
 	   PLAYERMAP_PLAYER_SORT_KEY_SUN => 'sun',
 	   PLAYERMAP_PLAYER_SORT_KEY_MON => 'mon',
 	   PLAYERMAP_PLAYER_SORT_KEY_TUE => 'tue',
 	   PLAYERMAP_PLAYER_SORT_KEY_WED => 'wed',
 	   PLAYERMAP_PLAYER_SORT_KEY_THU => 'thu',
 	   PLAYERMAP_PLAYER_SORT_KEY_FRI => 'fri',
 	   PLAYERMAP_PLAYER_SORT_KEY_SAT => 'sat',
 	   PLAYERMAP_PLAYER_SORT_KEY_HOL => 'hol',
 	   PLAYERMAP_PLAYER_SORT_KEY_PBN => 'pbn',
 	   PLAYERMAP_PLAYER_SORT_KEY_DESCRIPTION => 'description',
 	   PLAYERMAP_PLAYER_SORT_KEY_POSTTIME => 'posttime',

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
        return PLAYERMAP_PLAYER_SORT_KEY_DEFAULT;
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
    
		if (($value = $root->mContext->mRequest->getRequest('uid')) !== null) {
			$this->mNavi->addExtra('uid', $value);
			$this->_mCriteria->add(new Criteria('uid', $value));
		}
		if (($value = $root->mContext->mRequest->getRequest('name')) !== null) {
			$this->mNavi->addExtra('name', $value);
			$this->_mCriteria->add(new Criteria('name', $value));
		}
		if (($value = $root->mContext->mRequest->getRequest('gender')) !== null) {
			$this->mNavi->addExtra('gender', $value);
			$this->_mCriteria->add(new Criteria('gender', $value));
		}
		if (($value = $root->mContext->mRequest->getRequest('birthyear')) !== null) {
			$this->mNavi->addExtra('birthyear', $value);
			$this->_mCriteria->add(new Criteria('birthyear', $value));
		}
		if (($value = $root->mContext->mRequest->getRequest('startyear')) !== null) {
			$this->mNavi->addExtra('startyear', $value);
			$this->_mCriteria->add(new Criteria('startyear', $value));
		}
		if (($value = $root->mContext->mRequest->getRequest('pref_id')) !== null) {
			$this->mNavi->addExtra('pref_id', $value);
			$this->_mCriteria->add(new Criteria('pref_id', $value));
		}
		if (($value = $root->mContext->mRequest->getRequest('address')) !== null) {
			$this->mNavi->addExtra('address', $value);
			$this->_mCriteria->add(new Criteria('address', $value));
		}
		if (($value = $root->mContext->mRequest->getRequest('pl')) !== null) {
			$this->mNavi->addExtra('pl', $value);
			$this->_mCriteria->add(new Criteria('pl', $value));
		}
		if (($value = $root->mContext->mRequest->getRequest('role')) !== null) {
			$this->mNavi->addExtra('role', $value);
			$this->_mCriteria->add(new Criteria('role', $value));
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
