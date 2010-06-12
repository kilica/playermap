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
 * Rpglink_UpdateObject
**/
class Rpglink_UpdateObject extends XoopsSimpleObject
{
	const PRIMARY = 'update_id';
	const DATANAME = 'update';

	public $mLink = null;
	protected $_mLinkLoadedFlag = false;

	/**
	 * __construct
	 * 
	 * @param	void
	 * 
	 * @return	void
	**/
	public function __construct()
	{
		$this->initVar('update_id', XOBJ_DTYPE_INT, '', false);
		$this->initVar('title', XOBJ_DTYPE_STRING, '', false, 255);
		$this->initVar('link_id', XOBJ_DTYPE_INT, '', false);
		$this->initVar('url', XOBJ_DTYPE_STRING, '', false, 255);
		$this->initVar('update_time', XOBJ_DTYPE_INT, time(), false);
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
	 * @param	string	$req	link
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
			$value = $this->get('title');
			break;
		case 'uid' : 
			$this->loadLink();
			$value = $this->mLink->get('uid');
			break;
		case 'url' : 
			$value = $this->renderUri();
			break;
		case 'description' : 
			$value = $this->get('description');
			break;
		case 'subinfo' : 
			if($req!='link'){
				$this->loadLink();
				$value = $this->mLink->get('title');
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
 * Rpglink_UpdateHandler
**/
class Rpglink_UpdateHandler extends XoopsObjectGenericHandler
{
	public /*** string ***/ $mTable = '{dirname}_update';

	public /*** string ***/ $mPrimary = 'update_id';

	public /*** string ***/ $mClass = 'Rpglink_UpdateObject';

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
