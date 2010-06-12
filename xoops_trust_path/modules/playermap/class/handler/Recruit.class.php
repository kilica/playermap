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
 * Playermap_RecruitObject
**/
class Playermap_RecruitObject extends XoopsSimpleObject
{
	const PRIMARY = 'recruit_id';
	const DATANAME = 'recruit';

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
		$this->initVar('recruit_id', XOBJ_DTYPE_INT, '', false);
		$this->initVar('title', XOBJ_DTYPE_STRING, '', false, 255);
		$this->initVar('uid', XOBJ_DTYPE_INT, '', false);
		$this->initVar('group_id', XOBJ_DTYPE_INT, '', false);
		$this->initVar('endtime', XOBJ_DTYPE_INT, time(), false);
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
			$this->mGroup =& $handler->get($this->get($handler->mPrimary));
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
 * Playermap_RecruitHandler
**/
class Playermap_RecruitHandler extends XoopsObjectGenericHandler
{
	public /*** string ***/ $mTable = '{dirname}_recruit';

	public /*** string ***/ $mPrimary = 'recruit_id';

	public /*** string ***/ $mClass = 'Playermap_RecruitObject';

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
