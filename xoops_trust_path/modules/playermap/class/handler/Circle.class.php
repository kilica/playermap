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
 * Playermap_CircleObject
**/
class Playermap_CircleObject extends XoopsSimpleObject
{
	const PRIMARY = 'group_id';
	const DATANAME = 'circle';

	public $mGroup = null;
	protected $_mGroupLoadedFlag = false;

	/**
	 * __construct
	 * 
	 * @param	void
	 * 
	 * @return	void
	**/
	public function __construct()
	{
		$this->initVar('group_id', XOBJ_DTYPE_INT, '', false);
		$this->initVar('address', XOBJ_DTYPE_TEXT, '', false);
		$this->initVar('pref_id', XOBJ_DTYPE_INT, '', false);
		$this->initVar('grp_lat', XOBJ_DTYPE_FLOAT, '', false);
		$this->initVar('grp_lng', XOBJ_DTYPE_FLOAT, '', false);
		$this->initVar('sun', XOBJ_DTYPE_INT, '', false);
		$this->initVar('mon', XOBJ_DTYPE_INT, '', false);
		$this->initVar('tue', XOBJ_DTYPE_INT, '', false);
		$this->initVar('wed', XOBJ_DTYPE_INT, '', false);
		$this->initVar('thu', XOBJ_DTYPE_INT, '', false);
		$this->initVar('fri', XOBJ_DTYPE_INT, '', false);
		$this->initVar('sat', XOBJ_DTYPE_INT, '', false);
		$this->initVar('hol', XOBJ_DTYPE_INT, '', false);
		$this->initVar('pbn', XOBJ_DTYPE_INT, '', false);
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
	 * loadGroup
	 * 
	 * @param	void
	 * 
	 * @return	void
	 */
	public function loadGroup()
	{
		if ($this->_mGroupLoadedFlag == false) {
			$handler = Legacy_Utils::getModuleHandler('group', $this->getDirname());
			$this->mGroup =& $handler->get($this->get($this->mPrimary));
			$this->_mGroupLoadedFlag = true;
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
}

/**
 * Playermap_CircleHandler
**/
class Playermap_CircleHandler extends XoopsObjectGenericHandler
{
	public /*** string ***/ $mTable = '{dirname}_circle';

	public /*** string ***/ $mPrimary = 'group_id';

	public /*** string ***/ $mClass = 'Playermap_CircleObject';

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
