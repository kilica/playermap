<?php
/**
 * @file
 * @package trpg
 * @version $Id$
**/

if(!defined('XOOPS_ROOT_PATH'))
{
	exit;
}

require_once XOOPS_TRUST_PATH . '/modules/playermap/class/Enum.class.php';

interface Trpg_FormTag
{
	const RADIO = '<label><input type="radio" name="%s" value="%s" id="%s" %s%s />%s</label>';
}


/**
 * Pmenum_Currency
**/
class Pmenum_Currency extends Pmenum_AbstractField
{
	const NAME = 'currency';
	
	const JPY = 1;
	const USD = 2;

	/**
	 * show
	 * 
	 * @param	Enum	$value
	 * 
	 * @return	string
	**/
	public static function show(/*** Enum ***/ $value)
	{
		$list = self::getList();
		return $list[$value];
	}

	/**
	 * edit
	 * 
	 * @param	Enum	$value
	 * @param	string	$name
	 * @param	string	$class
	 * @param	string	$id
	 * 
	 * @return	string
	**/
	public static function edit(/*** Enum ***/ $value, /*** string ***/ $name='', /*** string ***/ $class=null, /*** string ***/ $id=null)
	{
		$name = $name ? $name : self::NAME;
		$id = isset($id) ? $id : self::PREFIX . $name;
		$class = $class ? '" class='.$class.'"' : null ;
		$tag = '';
		$list = self::getList();
		foreach($list as $k=>$item){
			$checked = ($value==$k) ? ' checked="checked"' : '';
			$tag .= sprintf(Playermap_FormTag::RADIO, $name, $k, $id, $class, $checked, $item);
		}
		return $tag;
	}



	/**
	 * getList
	 * 
	 * @param	void
	 * 
	 * @return	string[]
	**/
	public function getList()
	{
		return array(
			self::JPY=>_MD_TRPG_ENUM_JPY,
			self::USD=>_MD_TRPG_ENUM_USD,
		);
	}
}

/**
 * Pmenum_Btype	Player/Master
**/
class Pmenum_Btype extends Pmenum_AbstractField
{
	const NAME = 'btype';
	
	const PRIMARY = 1;
	const CORE = 2;
	const SUPPLEMENT = 5;

	/**
	 * show
	 * 
	 * @param	Enum	$value
	 * 
	 * @return	string
	**/
	public static function show(/*** Enum ***/ $value)
	{
		$list = self::getList();
		return $list[$value];
	}

	/**
	 * edit
	 * 
	 * @param	Enum	$value
	 * @param	string	$name
	 * @param	string	$class
	 * @param	string	$id
	 * 
	 * @return	string
	**/
	public static function edit(/*** Enum ***/ $value, /*** string ***/ $name='', /*** string ***/ $class=null, /*** string ***/ $id=null)
	{
		$name = $name ? $name : self::NAME;
		$id = isset($id) ? $id : self::PREFIX . $name;
		$class = $class ? '" class='.$class.'"' : null ;
		$tag = '';
		$list = self::getList();
		foreach($list as $k=>$item){
			$checked = ($value==$k) ? ' checked="checked"' : '';
			$tag .= sprintf(Playermap_FormTag::RADIO, $name, $k, $id, $class, $checked, $item);
		}
		return $tag;
	}

	/**
	 * getList
	 * 
	 * @param	void
	 * 
	 * @return	string[]
	**/
	public function getList()
	{
		return array(
			self::PRIMARY=>_MD_TRPG_ENUM_PRIMARY,
			self::CORE=>_MD_TRPG_ENUM_CORE,
			self::SUPPLEMENT=>_MD_TRPG_ENUM_SUPPLEMENT,
		);
	}
}

?>
