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

require_once PLAYERMAP_TRUST_PATH . '/class/AbstractAction.class.php';

/**
 * Playermap_Admin_ImageSettingAction
**/
class Playermap_Admin_ThumbnailSettingAction extends Playermap_AbstractAction
{
	/**
	 * getDefaultView
	 * 
	 * @param	void
	 * 
	 * @return	Enum
	**/
	public function getDefaultView()
	{
		$this->execute();
		return PLAYERMAP_FRAME_VIEW_SUCCESS;
	}

	/**
	 * execute
	 * 
	 * @param	void
	 * 
	 * @return	Enum
	**/
	public function execute()
	{
		$thumbnailArr = $this->_createThumbnailArray();
		$handler = Legacy_Utils::getModuleHandler('thumbnail', LEGACY_IMAGEMANAGER_DIRNAME);
		
		//check thumbnail settings
		$cri = new CriteriaCompo();
		$cri->add(new Criteria('dirname', 'playermap'));
		if(count($handler->getObjects($cri))>0){
			exit();
		}
	
		//insert thumbnail settings
		foreach($thumbnailArr as $thumb){
			$object = $handler->create();
			$object->set('dirname', $thumb['dirname']);
			$object->set('dataname', $thumb['dataname']);
			$object->set('max_width', $thumb['max_width']);
			$object->set('max_height', $thumb['max_height']);
			$object->set('file_type', $thumb['file_type']);
			$object->set('tsize', $thumb['tsize']);
			$handler->insert($object, true);
		}
	}

	protected function _createThumbnailArray()
	{
		$size1 = 120;
		$size2 = 80;
		$size3 = 48;
		return array(
			1=>array('dirname'=>PLAYERMAP_DIRNAME,'dataname'=>'group','max_width'=>$size1,'max_height'=>$size1,'file_type'=>0,'tsize'=>1),
			2=>array('dirname'=>PLAYERMAP_DIRNAME,'dataname'=>'group','max_width'=>$size2,'max_height'=>$size2,'file_type'=>0,'tsize'=>2),
			3=>array('dirname'=>PLAYERMAP_DIRNAME,'dataname'=>'group','max_width'=>$size3,'max_height'=>$size3,'file_type'=>0,'tsize'=>3),
		
			4=>array('dirname'=>PLAYERMAP_DIRNAME,'dataname'=>'player','max_width'=>$size1,'max_height'=>$size1,'file_type'=>0,'tsize'=>1),
			5=>array('dirname'=>PLAYERMAP_DIRNAME,'dataname'=>'player','max_width'=>$size2,'max_height'=>$size2,'file_type'=>0,'tsize'=>2),
			6=>array('dirname'=>PLAYERMAP_DIRNAME,'dataname'=>'player','max_width'=>$size3,'max_height'=>$size3,'file_type'=>0,'tsize'=>3),
		
			7=>array('dirname'=>PLAYERMAP_DIRNAME,'dataname'=>'conv','max_width'=>$size1,'max_height'=>$size1,'file_type'=>0,'tsize'=>1),
			8=>array('dirname'=>PLAYERMAP_DIRNAME,'dataname'=>'conv','max_width'=>$size2,'max_height'=>$size2,'file_type'=>0,'tsize'=>2),
			9=>array('dirname'=>PLAYERMAP_DIRNAME,'dataname'=>'conv','max_width'=>$size3,'max_height'=>$size3,'file_type'=>0,'tsize'=>3),
		
			10=>array('dirname'=>TRPG_DIRNAME,'dataname'=>'rpg','max_width'=>$size1,'max_height'=>$size1,'file_type'=>0,'tsize'=>1),
			11=>array('dirname'=>TRPG_DIRNAME,'dataname'=>'rpg','max_width'=>$size2,'max_height'=>$size2,'file_type'=>0,'tsize'=>2),
			12=>array('dirname'=>TRPG_DIRNAME,'dataname'=>'rpg','max_width'=>$size3,'max_height'=>$size3,'file_type'=>0,'tsize'=>3),

			13=>array('dirname'=>TRPG_DIRNAME,'dataname'=>'book','max_width'=>$size1,'max_height'=>$size1,'file_type'=>0,'tsize'=>1),
			14=>array('dirname'=>TRPG_DIRNAME,'dataname'=>'book','max_width'=>$size2,'max_height'=>$size2,'file_type'=>0,'tsize'=>2),
			15=>array('dirname'=>TRPG_DIRNAME,'dataname'=>'book','max_width'=>$size3,'max_height'=>$size3,'file_type'=>0,'tsize'=>3)
		);
	}

	/**
	 * executeViewSuccess
	 * 
	 * @param	XCube_RenderTarget	&$render
	 * 
	 * @return	void
	**/
	public function executeViewSuccess(&$render)
	{
		$this->mRoot->mController->executeForward($this->_getForwardUrl());
	}

	/**
	 * _getForwardUrl
	 * 
	 * @param	void
	 * 
	 * @return	string
	**/
	protected function _getForwardUrl()
	{
		return './index.php';
	}
}

?>