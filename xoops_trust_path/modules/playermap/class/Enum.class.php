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

interface Playermap_FormTag
{
	const RADIO = '<label><input type="radio" name="%s" value="%s" id="%s" %s%s />%s</label>';


}

abstract class Pmenum_AbstractField
{
	const PREFIX = 'legacy_xoopsform_';

	/**
	 * show
	 * 
	 * @param	Enum	$value
	 * 
	 * @return	string
	**/
	abstract public static function show(/*** Enum ***/ $value);

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
	abstract public static function edit(/*** Enum ***/ $value, /*** string ***/ $name='', /*** string ***/ $class='', /*** string ***/ $id='');

	/**
	 * getList
	 * 
	 * @param	void
	 * 
	 * @return	string[]
	**/
	abstract public function getList();
}

/**
 * Pmenum_Gender
**/
class Pmenum_Gender extends Pmenum_AbstractField
{
	const NAME = 'gender';
	
	const UNKNOWN = 0;
	const MALE = 1;
	const FEMALE = 2;

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
			self::UNKNOWN=>_MD_PLAYERMAP_ENUM_UNKNOWN,
			self::MALE=>_MD_PLAYERMAP_ENUM_MALE,
			self::FEMALE=>_MD_PLAYERMAP_ENUM_FEMALE,
		);
	}
}

/**
 * Pmenum_Role	Player/Master
**/
class Pmenum_Role extends Pmenum_AbstractField
{
	const NAME = 'role';
	
	const PLAYER = 1;
	const MASTER = 2;
	const BOTH = 3;

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
			self::PLAYER=>_MD_PLAYERMAP_ENUM_PLAYER,
			self::MASTER=>_MD_PLAYERMAP_ENUM_MASTER,
			self::BOTH=>_MD_PLAYERMAP_ENUM_BOTH,
		);
	}
}

/**
 * Pmenum_Off	Time-off status
**/
class Pmenum_Offtime extends Pmenum_AbstractField
{
	const NAME = 'offtime';
	
	const BUSY = 0;
	const ANNUAL = 1;
	const MONTHLY = 2;
	const WEEKLY = 3;

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
			self::BUSY=>_MD_PLAYERMAP_ENUM_BUSY,
			self::ANNUAL=>_MD_PLAYERMAP_ENUM_ANNUAL,
			self::MONTHLY=>_MD_PLAYERMAP_ENUM_MONTHLY,
			self::WEEKLY=>_MD_PLAYERMAP_ENUM_WEEKLY,
		);
	}
}

/**
 * Pmenum_Sche
**/
class Pmenum_Sche extends Pmenum_AbstractField
{
	const NAME = 'sche';
	
	const BUSY = 0;
	const MAYBE = 1;
	const FREE = 2;

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
			self::BUSY=>_MD_PLAYERMAP_ENUM_BUSY,
			self::MAYBE=>_MD_PLAYERMAP_ENUM_MAYBE,
			self::FREE=>_MD_PLAYERMAP_ENUM_FREE,
		);
	}
}

/**
 * Pmenum_Cstat	Conne Status
**/
class Pmenum_Cstat extends Pmenum_AbstractField
{
	const NAME = 'status';
	
	const NONE = 0;
	const ONEWAY = 1;
	const TWOWAY = 2;

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
			self::NONE=>_MD_PLAYERMAP_ENUM_NONE,
			self::ONEWAY=>_MD_PLAYERMAP_ENUM_ONEWAY,
			self::TWOWAY=>_MD_PLAYERMAP_ENUM_TWOWAY,
		);
	}
}

/**
 * Pmenum_Clevel	Conne Level
**/
class Pmenum_Clevel extends Pmenum_AbstractField
{
	const NAME = 'level';
	
	const NONE = 0;
	const ACCONMANY = 1;
	const FRIEND = 2;

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
			self::NONE=>_MD_PLAYERMAP_ENUM_NONE,
			self::ACCONPANY=>_MD_PLAYERMAP_ENUM_ACCONPANY,
			self::FRIEND=>_MD_PLAYERMAP_ENUM_FRIEND,
		);
	}
}

/**
 * Pmenum_Member	Group/Circle member rank
**/
class Pmenum_Member extends Pmenum_AbstractField
{
	const NAME = 'rank';
	
	const GUEST = 0;
	const ASSOCIATE = 1;
	const REGULAR = 2;
	const STAFF = 3;
	const OWNER = 9;

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
			self::GUEST=>_MD_PLAYERMAP_ENUM_GUEST,
			self::ASSOCIATE=>_MD_PLAYERMAP_ENUM_ASSOCIATE,
			self::REGULAR=>_MD_PLAYERMAP_ENUM_REGULAR,
			self::STAFF=>_MD_PLAYERMAP_ENUM_STAFF,
		);
	}
}

/**
 * Pmenum_Erole	Entry Player/Master
**/
class Pmenum_Erole extends Pmenum_AbstractField
{
	const NAME = 'role';
	
	const NONE = 0;
	const PLAYER = 1;
	const MASTER = 2;
	const EITHER = 3;
	const INVITED = 4;

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
			self::NONE=>_MD_PLAYERMAP_ENUM_NONE,
			self::PLAYER=>_MD_PLAYERMAP_ENUM_PLAYER,
			self::MASTER=>_MD_PLAYERMAP_ENUM_MASTER,
			self::EITHER=>_MD_PLAYERMAP_ENUM_EITHER,
			self::INVITED=>_MD_PLAYERMAP_ENUM_INVITED,
		);
	}
}

/**
 * Pmenum_Exp
**/
class Pmenum_Exp extends Pmenum_AbstractField
{
	const NAME = 'exp';
	
	const NONE = 0;
	const ONE = 1;
	const FEW = 2;
	const SEVERAL = 3;
	const MANY = 4;

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
			self::NONE=>_MD_PLAYERMAP_ENUM_FIRSTTIME,
			self::ONE=>_MD_PLAYERMAP_ENUM_ONETIME,
			self::FEW=>_MD_PLAYERMAP_ENUM_FEW,
			self::SEVERAL=>_MD_PLAYERMAP_ENUM_SEVERAL,
			self::MANY=>_MD_PLAYERMAP_ENUM_MANY,
		);
	}
}

/**
 * Pmenum_Booking
**/
class Pmenum_Booking extends Pmenum_AbstractField
{
	const NAME = 'booking';
	
	const NEEDNO = 0;
	const NEEDYES = 1;

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
			self::NEEDNO=>_MD_PLAYERMAP_ENUM_NEEDNO,
			self::NEEDYES=>_MD_PLAYERMAP_ENUM_NEEDYES,
		);
	}
}

/**
 * Pmenum_Rating
**/
class Pmenum_Rating extends Pmenum_AbstractField
{
	const NAME = 'rating';
	
	const RATE1 = 1;
	const RATE2 = 2;
	const RATE3 = 3;
	const RATE4 = 4;
	const RATE5 = 5;

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
			self::RATE1=>_MD_PLAYERMAP_ENUM_RATE1,
			self::RATE2=>_MD_PLAYERMAP_ENUM_RATE2,
			self::RATE3=>_MD_PLAYERMAP_ENUM_RATE3,
			self::RATE4=>_MD_PLAYERMAP_ENUM_RATE4,
			self::RATE5=>_MD_PLAYERMAP_ENUM_RATE5,
		);
	}
}

/**
 * Pmenum_Importance
**/
class Pmenum_Importance extends Pmenum_AbstractField
{
	const NAME = 'importance';
	
	const RATE1 = 1;
	const RATE2 = 2;
	const RATE3 = 3;
	const RATE4 = 4;
	const RATE5 = 5;

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
			self::RATE1=>_MD_PLAYERMAP_ENUM_IMPORTANCE1,
			self::RATE2=>_MD_PLAYERMAP_ENUM_IMPORTANCE2,
			self::RATE3=>_MD_PLAYERMAP_ENUM_IMPORTANCE3,
			self::RATE4=>_MD_PLAYERMAP_ENUM_IMPORTANCE4,
			self::RATE5=>_MD_PLAYERMAP_ENUM_IMPORTANCE5,
		);
	}
}

/**
 * Pmenum_Permission
**/
interface Pmenum_Permission
{
	const READ = 2;
	const WRITE = 5;
	const MANAGE = 9;
}

?>
