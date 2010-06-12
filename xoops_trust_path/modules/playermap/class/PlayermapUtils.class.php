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
 * Playermap_Utils
**/
class Playermap_Utils
{
	/**
	 * &getXoopsHandler
	 * 
	 * @param	string	$name
	 * @param	bool  $optional
	 * 
	 * @return	XoopsObjectHandler
	**/
	public static function &getXoopsHandler(/*** string ***/ $name,/*** bool ***/ $optional = false)
	{
		// TODO will be emulated xoops_gethandler
		return xoops_gethandler($name,$optional);
	}

	/**
	 * &getModuleHandler
	 * 
	 * @param	string	$name
	 * @param	string	$dirname
	 * 
	 * @return	XoopsObjectHandleer
	**/
	public static function &getModuleHandler(/*** string ***/ $name,/*** string ***/ $dirname)
	{
		// TODO will be emulated xoops_getmodulehandler
		return xoops_getmodulehandler($name,$dirname);
	}

	/**
	 * &getPlayermapHandler
	 * 
	 * @param	string	$name
	 * @param	string	$dirname
	 * 
	 * @return	XoopsObjectHandleer
	**/
	public static function &getPlayermapHandler(/*** string ***/ $name,/*** string ***/ $dirname)
	{
		$asset = null;
		XCube_DelegateUtils::call(
			'Module.playermap.Global.Event.GetAssetManager',
			new XCube_Ref($asset),
			$dirname
		);
		if(is_object($asset) && is_a($asset, 'Playermap_AssetManager'))
		{
			return $asset->getObject('handler',$name);
		}
	}

	/**
	 * getEnv
	 * 
	 * @param	string	$key
	 * 
	 * @return	string
	**/
	public static function getEnv(/*** string ***/ $key)
	{
		return getenv($key);
	}

	/**
	 * getChildObjects
	 * 
	 * @param	string	$dirname	//parent dirname
	 * @param	string	$dataname	//parent dataname
	 * @param	int		$data_id	//parent data_id
	 * @param	string	$childname	//child dataname
	 * @param	int		$limit
	 * @param	int		$start
	 * 
	 * @return	string
	**/
	public static function getChildObjects(/*** string ***/ $dirname, /*** string ***/ $dataname, /*** int ***/ $data_id, /*** string ***/ $childname, /*** int ***/ $limit=10, /*** int ***/ $start=0)
	{
		$handler = Legacy_Utils::getModuleHandler($dataname, $dirname);
		return $handler->getChildObjects($data_id, $childname, $limit, $start);
	}

	/**
	 * getMyRpg
	 * 
	 * @param	int		$fNum
	 * @param	int		$lNum
	 * 
	 * @return	Trpg_RpgObject[]
	**/
	public static function getMyRpg($fNum=5, $lNum=5)
	{
		$uid = Legacy_Utils::getUid();
	
		$handler = Legacy_Utils::getModuleHandler('favrpg', PLAYERMAP_DIRNAME);
		$cri = new CriteriaCompo();
		$cri->add(new Criteria('uid', $uid));
		$cri->add(new Criteria('rating', Pmenum_Rating::RATE3, '>='));
		$cri->setSort('rating', 'DESC');
		$favrpg = $handler->getObjects($cri, $fNum, 0);
		$rpgIds = array();
		foreach($favrpg as $objF){
			$rpgIds[] = $objF->get('rpg_id');
		}
	
		$handler = Legacy_Utils::getModuleHandler('entry', PLAYERMAP_DIRNAME);
		$entry = $handler->getObjects(new Criteria('uid', $uid));
		$logIds = array();
		foreach($entry as $objE){
			$logIds[$objE->get('log_id')] ++;
		}
		arsort($logIds);
	
		$i = 0;
		$handler = Legacy_Utils::getModuleHandler('log', PLAYERMAP_DIRNAME);
		$log = $handler->getObjects(new Criteria('log_id', $logIds, 'IN'));
		foreach($log as $objL){
			if($i<=$lNum && ! in_array($objL->get('rpg_id'), $rpgIds)){
				$rpgIds[] = $objL->get('rpg_id');
				$i++;
			}
		}
	
		$handler = Legacy_Utils::getModuleHandler('rpg', TRPG_DIRNAME);
		return $handler->getObjects(new Criteria('rpg_id', $rpgIds, 'IN'));
	}

	/**
	 * getSearchList
	 * 
	 * @param	string	$dataname
	 * 
	 * @return	XoopsSimpleObject[]
	**/
	public static function getSearchList(/*** string ***/ $dataname)
	{
		$list = array('id'=>array(), 'title'=>array(), 'search'=>array());
		switch($dataname){
		case 'rpg':
			$handler = Legacy_Utils::getModuleHandler($dataname, TRPG_DIRNAME);
			$objs = $handler->getObjects();
			foreach($objs as $obj){
				$list['id'][] = $obj->get('rpg_id');
				$list['title'][] = $obj->get('title');
				$list['search'][] = $obj->get('kana').'|'.$obj->get('abbr');
			}
			break;
		case 'book':
			$handler = Legacy_Utils::getModuleHandler($dataname, TRPG_DIRNAME);
			$objs = $handler->getObjects();
			foreach($objs as $obj){
				$list['id'][] = $obj->get('book_id');
				$list['title'][] = $obj->get('title');
				$list['search'][] = $obj->get('kana');
			}
			break;
		case 'player':
			$handler = Legacy_Utils::getModuleHandler($dataname, PLAYERMAP_DIRNAME);
			$objs = $handler->getObjects();
			foreach($objs as $obj){
				$list['id'][] = $obj->get('uid');
				$list['title'][] = $obj->get('name');
				$list['search'][] = '';
			}
			break;
		case 'group':
			$handler = Legacy_Utils::getModuleHandler($dataname, PLAYERMAP_DIRNAME);
			$objs = $handler->getObjects();
			foreach($objs as $obj){
				$list['id'][] = $obj->get('group_id');
				$list['title'][] = $obj->get('title');
				$list['search'][] = '';
			}
			break;
		}
	
		return $list;
	}

	/**
	 * getImageTag
	 * 
	 * @param	XoopsSimpleObject	$obj
	 * @param	int		$tsize
	 * @param	string	$link
	 * 
	 * @return	XoopsSimpleObject[]
	**/
	public static function getImageTag(/*** XoopsSimpleObject ***/ $obj, /*** int ***/ $tsize=1, /*** string ***/ $link=null)
	{
		$tag = null;
		$image = $obj->getImage();
		if($image){
			switch($link){
			case 'original':
				$html = '<a href="%s">%s</a>';
				$tag = sprintf($html, $image->getFileUrl(), $image->makeImageTag($tsize));
				break;
			case 'source':
				$html = '<a href="%s">%s</a>';
				$tag = sprintf($html, Legacy_Utils::renderUri($image->getShow('dirname'), $image->getShow('dataname'), $image->getShow('data_id')), $image->makeImageTag($tsize));
				break;
			default:
				$tag = $image->makeImageTag($tsize);
				break;
			}
		}
		else{
			switch($tsize){
				case 1:$noimage='noimage120.gif';break;
				case 2:$noimage='noimage80.gif';break;
			}
			switch($link){
			case 'source':
				$html = '<a href="%s"><img src="%s%s" alt="noimage" /></a>';
				$tag = sprintf($html, Legacy_Utils::renderUri($obj->getDirname(), $obj->getDataname(), $obj->getShow($obj->getPrimary())), XOOPS_MODULE_URL.'/playermap/images/', $noimage);
				break;
			default:
				$tag = sprintf('<img src="%s%s" alt="noimage" />', XOOPS_MODULE_URL.'/playermap/images/', $noimage);
				break;
			}
		}
		return $tag;
	}
}

?>
