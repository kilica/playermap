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
 * Playermap_FavrpgObject
**/
class Playermap_FavrpgObject extends XoopsSimpleObject
{
	const PRIMARY = 'favrpg_id';
	const DATANAME = 'favrpg';

	public $mPlayer = null;
	protected $_mPlayerLoadedFlag = false;
	public $mRpg = null;
	protected $_mRpgLoadedFlag = false;

	/**
	 * __construct
	 * 
	 * @param	void
	 * 
	 * @return	void
	**/
	public function __construct()
	{
		$this->initVar('favrpg_id', XOBJ_DTYPE_INT, '', false);
		$this->initVar('rpg_id', XOBJ_DTYPE_INT, '', false);
		$this->initVar('uid', XOBJ_DTYPE_INT, '', false);
		$this->initVar('rating', XOBJ_DTYPE_INT, Pmenum_Rating::RATE3, false);
		$this->initVar('player', XOBJ_DTYPE_INT, 0, false);
		$this->initVar('master', XOBJ_DTYPE_INT, 0, false);
		$this->initVar('since', XOBJ_DTYPE_INT, 0, false);
		$this->initVar('owner', XOBJ_DTYPE_BOOL, 0, false);
		$this->initVar('description', XOBJ_DTYPE_TEXT, '', false);
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
	 * loadRpg
	 * 
	 * @param	void
	 * 
	 * @return	void
	 */
	public function loadRpg()
	{
		if ($this->_mRpgLoadedFlag == false) {
			$handler = Legacy_Utils::getModuleHandler('rpg', TRPG_DIRNAME);
			$this->mRpg =& $handler->get($this->get($handler->mPrimary));
			$this->_mRpgLoadedFlag = true;
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
			if($req=='player'){
				$this->loadRpg();
				$value = $this->mRpg->get('title');
			}
			elseif($req=='rpg'){
				$this->loadPlayer();
				$value = $this->mPlayer->get('name');
			}
			break;
		case 'uid' : 
			$value = $this->get('uid');
			break;
		case 'url' : 
			if($req=='player'){
				$this->loadRpg();
				$value = $this->mRpg->renderUri();
			}
			elseif($req=='rpg'){
				$this->loadPlayer();
				$value = $this->mPlayer->renderUri();
			}
			break;
		case 'imageTag' : 
			if($req=='player'){
				$this->loadRpg();
				$value = Playermap_Utils::getImageTag($this->mRpg, $tsize, 'source');
			}
			elseif($req=='rpg'){
				$this->loadPlayer();
				$value = Playermap_Utils::getImageTag($this->mPlayer, $tsize, 'source');
			}
			break;
		case 'subinfo' : 
			$value = $this->get('rating');
			break;
		case 'pubtime' : 
			$value = $this->get('posttime');
			break;
		}
		return $value;
	}
}

/**
 * Playermap_FavrpgHandler
**/
class Playermap_FavrpgHandler extends XoopsObjectGenericHandler
{
	public /*** string ***/ $mTable = '{dirname}_favrpg';

	public /*** string ***/ $mPrimary = 'favrpg_id';

	public /*** string ***/ $mClass = 'Playermap_FavrpgObject';

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

}

?>
