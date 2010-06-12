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

define('PLAYERMAP_CONNE_SORT_KEY_CONNE_ID', 1);
define('PLAYERMAP_CONNE_SORT_KEY_UID', 2);
define('PLAYERMAP_CONNE_SORT_KEY_CONNE_UID', 3);
define('PLAYERMAP_CONNE_SORT_KEY_LEVEL', 4);
define('PLAYERMAP_CONNE_SORT_KEY_STAT', 5);
define('PLAYERMAP_CONNE_SORT_KEY_ACCEPTTIME', 6);
define('PLAYERMAP_CONNE_SORT_KEY_POSTTIME', 7);

define('PLAYERMAP_CONNE_SORT_KEY_DEFAULT', PLAYERMAP_CONNE_SORT_KEY_CONNE_ID);

/**
 * Playermap_ConneFilterForm
**/
class Playermap_ConneFilterForm extends Playermap_AbstractFilterForm
{
    public /*** string[] ***/ $mSortKeys = array(
 	   PLAYERMAP_CONNE_SORT_KEY_CONNE_ID => 'conne_id',
 	   PLAYERMAP_CONNE_SORT_KEY_UID => 'uid',
 	   PLAYERMAP_CONNE_SORT_KEY_CONNE_UID => 'conne_uid',
 	   PLAYERMAP_CONNE_SORT_KEY_LEVEL => 'level',
 	   PLAYERMAP_CONNE_SORT_KEY_STAT => 'stat',
 	   PLAYERMAP_CONNE_SORT_KEY_ACCEPTTIME => 'accepttime',
 	   PLAYERMAP_CONNE_SORT_KEY_POSTTIME => 'posttime',

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
        return PLAYERMAP_CONNE_SORT_KEY_DEFAULT;
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
    
		if (($value = $root->mContext->mRequest->getRequest('conne_id')) !== null) {
			$this->mNavi->addExtra('conne_id', $value);
			$this->_mCriteria->add(new Criteria('conne_id', $value));
		}
		if (($value = $root->mContext->mRequest->getRequest('uid')) !== null) {
			$this->mNavi->addExtra('uid', $value);
			$this->_mCriteria->add(new Criteria('uid', $value));
		}
		if (($value = $root->mContext->mRequest->getRequest('conne_uid')) !== null) {
			$this->mNavi->addExtra('conne_uid', $value);
			$this->_mCriteria->add(new Criteria('conne_uid', $value));
		}
		if (($value = $root->mContext->mRequest->getRequest('level')) !== null) {
			$this->mNavi->addExtra('level', $value);
			$this->_mCriteria->add(new Criteria('level', $value));
		}
		if (($value = $root->mContext->mRequest->getRequest('stat')) !== null) {
			$this->mNavi->addExtra('stat', $value);
			$this->_mCriteria->add(new Criteria('stat', $value));
		}
		if (($value = $root->mContext->mRequest->getRequest('accepttime')) !== null) {
			$this->mNavi->addExtra('accepttime', $value);
			$this->_mCriteria->add(new Criteria('accepttime', $value));
		}
		if (($value = $root->mContext->mRequest->getRequest('posttime')) !== null) {
			$this->mNavi->addExtra('posttime', $value);
			$this->_mCriteria->add(new Criteria('posttime', $value));
		}

    
        $this->_mCriteria->addSort($this->getSort(), $this->getOrder());
    }
}

?>
