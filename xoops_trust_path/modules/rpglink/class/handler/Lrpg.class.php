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

/**
 * Rpglink_LrpgObject
**/
class Rpglink_LrpgObject extends XoopsSimpleObject
{
	const PRIMARY = 'lrpg_id';
	const DATANAME = 'lrpg';

	public $mLink = null;
	protected $_mLinkLoadedFlag = false;
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
		$this->initVar('lrpg_id', XOBJ_DTYPE_INT, '', false);
		$this->initVar('rpg_id', XOBJ_DTYPE_INT, '', false);
		$this->initVar('link_id', XOBJ_DTYPE_INT, '', false);
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
	 * loadLink
	 * 
	 * @param	void
	 * 
	 * @return	void
	 */
	public function loadLink()
	{
		if ($this->_mLinkLoadedFlag == false) {
			$handler = Legacy_Utils::getModuleHandler('link', $this->getDirname());
			$this->mLink =& $handler->get($this->get('link_id'));
			$this->_mLinkLoadedFlag = true;
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
			$this->mRpg =& $handler->get($this->get('rpg_id'));
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
	 * @param	string	$req	link, rpg
	 * 
	 * @return	void
	 */
	public function getCommonValue(/*** string ***/ $key, /*** string ***/ $req=null)
	{
		$value = null;
		switch($key){
		case 'data_id': 
			$value = $this->get(self::PRIMARY);
			break;
		case 'title' : 
			if($req=='link'){
				$this->loadRpg();
				$value = $this->mRpg->get('title');
			}
			elseif($req=='rpg'){
				$this->loadLink();
				$value = $this->mLink->get('title');
			}
			break;
		case 'uid' : 
			$value = $this->mLink->get('uid');
			break;
		case 'url' : 
			if($req=='link'){
				$this->loadRpg();
				$value = $this->mRpg->renderUri();
			}
			elseif($req=='rpg'){
				$this->loadLink();
				$value = $this->mLink->renderUri();
			}
			break;
		case 'description' : 
			if($req=='link'){
				$this->loadRpg();
				$value = $this->mRpg->get('description');
			}
			elseif($req=='rpg'){
				$this->loadLink();
				$value = $this->mLink->get('description');
			}
			break;
		case 'pubtime' : 
			$value = $this->get('posttime');
			break;
		}
		return $value;
	}
}

/**
 * Rpglink_LrpgHandler
**/
class Rpglink_LrpgHandler extends XoopsObjectGenericHandler
{
	public /*** string ***/ $mTable = '{dirname}_lrpg';

	public /*** string ***/ $mPrimary = 'lrpg_id';

	public /*** string ***/ $mClass = 'Rpglink_LrpgObject';

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
