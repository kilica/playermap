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

/**
 * Playermap_ConneObject
**/
class Playermap_ConneObject extends XoopsSimpleObject
{
	const PRIMARY = 'conne_id';
	const DATANAME = 'conne';

	public $mPlayer = null;
	protected $_mPlayerLoadedFlag = false;
	public $mFriend = null;
	protected $_mFriendLoadedFlag = false;

	/**
	 * __construct
	 * 
	 * @param	void
	 * 
	 * @return	void
	**/
	public function __construct()
	{
		$this->initVar('conne_id', XOBJ_DTYPE_INT, '', false);
		$this->initVar('uid', XOBJ_DTYPE_INT, '', false);
		$this->initVar('conne_uid', XOBJ_DTYPE_INT, '', false);
		$this->initVar('level', XOBJ_DTYPE_INT, Pmenum_Clevel::FRIEND, false);
		$this->initVar('stat', XOBJ_DTYPE_INT, Pmenum_Cstat::ONEWAY, false);
		$this->initVar('accepttime', XOBJ_DTYPE_INT, 0, false);
		$this->initVar('posttime', XOBJ_DTYPE_INT, time(), false);
	}

	/**
	 * getPrimary
	 * 
	 * @param	void
	 * 
	 * @return	string
	**/
	public function getPrimary()
	{
		return self::PRIMARY;
	}

	/**
	 * getDataname
	 * 
	 * @param	void
	 * 
	 * @return	string
	**/
	public function getDataname()
	{
		return self::DATANAME;
	}

	/**
	 * loadPlayer
	 * 
	 * @param	void
	 * 
	 * @return	void
	 */
	public function loadPlayer()
	{
		if ($this->_mPlayerLoadedFlag == false) {
			$handler = Legacy_Utils::getModuleHandler('player', $this->getDirname());
			$this->mPlayer =& $handler->get($this->get($handler->mPrimary));
			$this->_mPlayerLoadedFlag = true;
		}
	}

	/**
	 * loadFriend
	 * 
	 * @param	void
	 * 
	 * @return	void
	 */
	public function loadFriend()
	{
		if ($this->_mFriendLoadedFlag == false) {
			$handler = Legacy_Utils::getModuleHandler('player', $this->getDirname());
			$this->mFriend =& $handler->get($this->get('conne_uid'));
			$this->_mFriendLoadedFlag = true;
		}
	}

	/**
	 * renderUri
	 * 
	 * @param	void
	 * 
	 * @return	string
	 */
	public function renderUri()
	{
		return Legacy_Utils::renderUri($this->getDirname(), null, $this->get(self::PRIMARY));
	}

	/**
	 * getCommonValue
	 * 
	 * @param	string	$key	data_id, title, uid, pubtime
	 * @param	string	$req	player, rpg
	 * @param	int		$tsize	thumbnail size
	 * 
	 * @return	void
	 */
	public function getCommonValue(/*** string ***/ $key, /*** string ***/ $req=null, /*** int ***/ $tsize=2)
	{
		$value = null;
		switch($key){
		case 'data_id': 
			$value = $this->get(self::PRIMARY);
			break;
		case 'title' : 
			$this->loadFriend();
			$value = $this->mFriend->get('name');
			break;
		case 'uid' : 
			$value = $this->get('uid');
			break;
		case 'url' : 
			$this->loadFriend();
			$value = $this->mFriend->renderUri();
			break;
		case 'imageTag' : 
			$this->loadFriend();
			$value = Playermap_Utils::getImageTag($this->mFriend, $tsize, 'source');
		case 'description' : 
			$this->loadFriend();
			$value = $this->mFriend->get('desctiption');
			break;
		case 'pubtime' : 
			$value = $this->get('posttime');
			break;
		}
		return $value;
	}
}

/**
 * Playermap_ConneHandler
**/
class Playermap_ConneHandler extends XoopsObjectGenericHandler
{
	public /*** string ***/ $mTable = '{dirname}_conne';

	public /*** string ***/ $mPrimary = 'conne_id';

	public /*** string ***/ $mClass = 'Playermap_ConneObject';

	/**
	 * __construct
	 * 
	 * @param	XoopsDatabase  &$db
	 * @param	string	$dirname
	 * 
	 * @return	void
	**/
	public function __construct(/*** XoopsDatabase ***/ &$db,/*** string ***/ $dirname)
	{
		$this->mTable = strtr($this->mTable,array('{dirname}' => $dirname));
		parent::XoopsObjectGenericHandler($db);
	}

	/**
	 * getFriendList
	 * 
	 * @param	int		$uid
	 * @param	Enum	$uid
	 * 
	 * @return	int[]
	 */
	public function getFriendIdList(/*** int ***/ $uid, /*** Enum ***/ $stat=Pmenum_Cstat::TWOWAY)
	{
		$cri = new CriteriaCompo();
		$cri->add(new Criteria('uid', $uid));
		$cri->add(new Criteria('stat', $stat, '>='));
		if($stat==Pmenum_Cstat::ONEWAY){
			$cri->setSort('posttime', 'DESC');
		}
		elseif($stat==Pmenum_Cstat::TWOWAY){
			$cri->setSort('accepttime', 'DESC');
		}
		$objs = $this->getObjects($cri);
		$list = array();
		foreach(array_keys($objs) as $key){
			$list[] = $objs[$key]->get('conne_uid');
		}
		return $list;
	}

	/**
	 * isFriend
	 * 
	 * @param	int	$uid
	 * @param	int	$friend_uid
	 * 
	 * @return	bool
	 */
	public function isFriend(/*** int ***/ $uid, /*** int ***/ $friend_uid)
	{
		$cri = new CriteriaCompo();
		$cri->add(new Criteria('uid', $uid));
		$cri->add(new Criteria('conne_uid', $friend_uid));
		$cri->add(new Criteria('stat', Pmenum_Cstat::TWOWAY));
		$ids = $this->getIdList($cri);
		return (count($ids)===1) ? true : false;
	}

	/**
	 * delete
	 * 
	 * @param	int		$object
	 * @param	bool	$force
	 * 
	 * @return	bool
	 */
	public function delete(/*** Playermap_ConneObject ***/ $obj, /*** bool ***/ $force = false)
	{
		if(parent::delete($obj, $force)){
			$cri = new CriteriaCompo();
			$cri->add(new Criteria('uid', $obj->get('conne_uid')));
			$cri->add(new Criteria('conne_uid', $obj->get('uid')));
			$objs = $this->getObjects($cri);
			if(count($objs)===1){
				$obj = array_shift($objs);
				$obj->set('stat', Pmenum_Cstat::ONEWAY);
				$this->insert($obj);
			}
			return true;
		}
		return false;
	}

	/**
	 * insert
	 * 
	 * @param	int		$object
	 * @param	bool	$force
	 * 
	 * @return	bool
	 */
	public function insert(/*** Playermap_ConneObject ***/ $obj, /*** bool ***/ $force = false)
	{
		$cri = new CriteriaCompo();
		$cri->add(new Criteria('uid', $obj->get('conne_uid')));
		$cri->add(new Criteria('conne_uid', $obj->get('uid')));
		$conneArr = $this->getObjects($cri);
		if(count($conneArr)===1){
			$time = time();
			$conne = array_shift($conneArr);
			$conne->set('stat', Pmenum_Cstat::TWOWAY);
			$conne->set('accepttime', $time);
			$obj->set('stat', Pmenum_Cstat::TWOWAY);
			$obj->set('accepttime', $time);
		}
	
		if(parent::insert($obj, $force)){
			if(isset($conne)){
				$this->insert($conne);
			}
			return true;
		}
		return false;
	}

}

?>
