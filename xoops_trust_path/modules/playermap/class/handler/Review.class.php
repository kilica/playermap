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
 * Playermap_ReviewObject
**/
class Playermap_ReviewObject extends XoopsSimpleObject
{
	const PRIMARY = 'review_id';
	const DATANAME = 'review';

	public $mBook = null;
	protected $_mBookLoadedFlag = false;
	public $mPlayer = null;
	protected $_mPlayerLoadedFlag = false;

	/**
	 * __construct
	 * 
	 * @param	void
	 * 
	 * @return	void
	**/
	public function __construct()
	{
		$this->initVar('review_id', XOBJ_DTYPE_INT, '', false);
		$this->initVar('book_id', XOBJ_DTYPE_INT, '', false);
		$this->initVar('uid', XOBJ_DTYPE_INT, '', false);
		$this->initVar('rating', XOBJ_DTYPE_INT, '', false);
		$this->initVar('importance', XOBJ_DTYPE_INT, '', false);
		$this->initVar('owner', XOBJ_DTYPE_BOOL, '', false);
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
	 * loadBook
	 * 
	 * @param	void
	 * 
	 * @return	void
	 */
	public function loadBook()
	{
		if ($this->_mBookLoadedFlag == false) {
			$handler = Legacy_Utils::getModuleHandler('book', TRPG_DIRNAME);
			$this->mBook =& $handler->get($this->get($handler->mPrimary));
			$this->_mBookLoadedFlag = true;
		}
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
			$handler = Legacy_Utils::getModuleHandler('player', PLAYERMAP_DIRNAME);
			$this->mPlayer =& $handler->get($this->get($handler->mPrimary));
			$this->_mPlayerLoadedFlag = true;
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
		switch($key){
		case 'data_id': 
			$value = $this->get('entry_id');
			break;
		case 'title' : 
			if($req=='player'){
				$this->loadBook();
				$value = $this->mBook->get('title');
			}
			elseif($req=='book'){
				$this->loadPlayer();
				$value = $this->mPlayer->get('name');
			}
			break;
		case 'uid' : 
			$value = $this->get('uid');
			break;
		case 'url' : 
			if($req=='player'){
				$this->loadBook();
				$value = $this->mBook->renderUri();
			}
			elseif($req=='book'){
				$this->loadPlayer();
				$value = $this->mPlayer->renderUri();
			}
			break;
		case 'imageTag' : 
			if($req=='player'){
				$this->loadBook();
				$value = Playermap_Utils::getImageTag($this->mBook, $tsize, 'source');
			}
			elseif($req=='book'){
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
 * Playermap_ReviewHandler
**/
class Playermap_ReviewHandler extends XoopsObjectGenericHandler
{
	public /*** string ***/ $mTable = '{dirname}_review';

	public /*** string ***/ $mPrimary = 'review_id';

	public /*** string ***/ $mClass = 'Playermap_ReviewObject';

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
