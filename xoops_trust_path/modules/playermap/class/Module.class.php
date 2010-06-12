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

define('PLAYERMAP_FRAME_PERFORM_SUCCESS', 1);
define('PLAYERMAP_FRAME_PERFORM_FAIL', 2);
define('PLAYERMAP_FRAME_INIT_SUCCESS', 3);

define('PLAYERMAP_FRAME_VIEW_NONE','none');
define('PLAYERMAP_FRAME_VIEW_SUCCESS','success');
define('PLAYERMAP_FRAME_VIEW_ERROR','error');
define('PLAYERMAP_FRAME_VIEW_INDEX','index');
define('PLAYERMAP_FRAME_VIEW_INPUT','input');
define('PLAYERMAP_FRAME_VIEW_PREVIEW','preview');
define('PLAYERMAP_FRAME_VIEW_CANCEL','cancel');

/**
 * Playermap_Module
**/
class Playermap_Module extends Legacy_ModuleAdapter
{
	public /*** string ***/ $mActionName = null;

	public /*** Playermap_AbstractAction ***/ $mAction = null;

	public /*** bool ***/ $mAdminFlag = false;

	public /*** Playermap_AssetManager ***/ $mAssetManager = null;

	protected /*** string ***/ $_mPreferenceEditUrl = null;

	protected /*** string ***/ $_mHelpViewUrl = null;

	protected /*** Enum[] ***/ $_mAllowViewNames = array(
		PLAYERMAP_FRAME_VIEW_NONE,
		PLAYERMAP_FRAME_VIEW_SUCCESS,
		PLAYERMAP_FRAME_VIEW_ERROR,
		PLAYERMAP_FRAME_VIEW_INDEX,
		PLAYERMAP_FRAME_VIEW_INPUT,
		PLAYERMAP_FRAME_VIEW_PREVIEW,
		PLAYERMAP_FRAME_VIEW_CANCEL
	);

	/**
	 * startup
	 * 
	 * @param	void
	 * 
	 * @return	void
	**/
	public function startup()
	{
		parent::startup();
	
		XCube_DelegateUtils::call('Module.playermap.Global.Event.GetAssetManager',new XCube_Ref($this->mAssetManager),$this->mXoopsModule->get('dirname'));
	
		$root =& XCube_Root::getSingleton();
		$root->mController->mExecute->add(array(&$this, 'execute'));
	
		//
		// TODO/Insert your initialization code.
		//
	}

	/**
	 * setAdminMode
	 * 
	 * @param	bool  $flag
	 * 
	 * @return	void
	**/
	public function setAdminMode(/*** bool ***/ $flag)
	{
		$this->mAdminFlag = $flag;
	}

	/**
	 * _getDefaultActionName
	 * 
	 * @param	void
	 * 
	 * @return	string
	**/
	private function _getDefaultActionName()
	{
		$req = XCube_Root::getSingleton()->mContext->mRequest;
		$dataId = $req->getRequest(_REQUESTED_DATA_ID);
		$dataname = $req->getRequest(_REQUESTED_DATA_NAME);
		$dataname = isset($dataname) ? $dataname : 'player';
		$action = $req->getRequest(_REQUESTED_ACTION_NAME);
	
		if($dataId>0){
			if(isset($action)){
				$actionName = ucfirst($dataname).ucfirst($action);
			}
			else{
				$actionName = ucfirst($dataname).'View';
			}
		}
		else{
			if(isset($action)){
				$actionName = ucfirst($dataname).ucfirst($action);
			}
			else{
				$actionName = ucfirst($dataname).'List';
			}
		}
	
		return $actionName;
	}

	/**
	 * setActionName
	 * 
	 * @param	string	$name
	 * 
	 * @return	void
	**/
	public function setActionName(/*** string ***/ $name)
	{
		$this->mActionName = $name;
	}

	/**
	 * getRenderSystemName
	 * 
	 * @param	void
	 * 
	 * @return	string
	**/
	public function getRenderSystemName()
	{
		if(!$this->mAdminFlag)
		{
			return parent::getRenderSystemName();
		}
	
		// TODO will be use site config
		if(!defined('PLAYERMAP_ADMIN_RENDER_REGISTED'))
		{
			define('PLAYERMAP_ADMIN_RENDER_REGISTED',true);
			$root =& XCube_Root::getSingleton();
			$root->overrideSiteConfig(
				array(
					'RenderSystems' => array(
						'Playermap_AdminRenderSystem' => 'Playermap_AdminRenderSystem'
					),
					'Playermap_AdminRenderSystem' => array(
						'root' => PLAYERMAP_TRUST_PATH,
						'path' => '/admin/class/PlayermapAdminRenderSystem.class.php',
						'class' => 'Playermap_AdminRenderSystem'
					)
				)
			);
		}
	
		return 'Playermap_AdminRenderSystem';
	}

	/**
	 * getAdminMenu
	 * 
	 * @param	void
	 * 
	 * @return	{string 'title',string 'link',string 'keywords',bool 'show',bool 'absolute'}[]
	**/
	public function getAdminMenu()
	{
		if(is_array($this->mAdminMenu))
		{
			return $this->mAdminMenu;
		}
	
		$root =& XCube_Root::getSingleton();
	
		// load admin menu
		$adminMenu = $this->mXoopsModule->getInfo('adminmenu');
		if(!is_array($adminMenu))
		{
			$adminMenu = array();
		}
	
		// add preference menu
		if($url = $this->getPreferenceEditUrl())
		{
			$adminMenu[] = array(
				'title'    => _PREFERENCES,
				'link'	   => $url,
				'absolute' => true
			);
		}
	
		// add help menu
		if($url = $this->getHelpViewUrl())
		{
			$adminMenu[] = array(
				'title'    => _HELP,
				'link'	   => $url,
				'absolute' => true
			);
		}
	
		$this->mAdminMenu = array();
		foreach($adminMenu as $menu)
		{
			if(!(isset($menu['absolute']) && $menu['absolute']))
			{
				$menu['link'] = XOOPS_MODULE_URL . '/' . $this->mXoopsModule->get('dirname') . '/' . $menu['link'];
			}
			$this->mAdminMenu[] = $menu;
		}
	
		return $this->mAdminMenu;
	}

	/**
	 * getPreferenceEditUrl
	 * 
	 * @param	void
	 * 
	 * @return	string
	**/
	public function getPreferenceEditUrl()
	{
		if($this->_mPreferenceEditUrl === null)
		{
			if(is_array($this->mXoopsModule->getInfo('config')) && count($this->mXoopsModule->getInfo('config')) > 0)
			{
				$root =& XCube_Root::getSingleton();
				$this->_mPreferenceEditUrl = $root->mController->getPreferenceEditUrl($this->mXoopsModule);
			}
			else
			{
				$this->_mPreferenceEditUrl = false;
			}
		}
	
		return $this->_mPreferenceEditUrl;
	}

	/**
	 * getHelpViewUrl
	 * 
	 * @param	void
	 * 
	 * @return	string
	**/
	public function getHelpViewUrl()
	{
		if($this->_mHelpViewUrl === null)
		{
			if($this->mXoopsModule->hasHelp())
			{
				$root =& XCube_Root::getSingleton();
				$this->_mHelpViewUrl = $root->mController->getHelpViewUrl($this->mXoopsModule);
			}
			else
			{
				$this->_mHelpViewUrl = false;
			}
		}
	
		return $this->_mHelpViewUrl;
	}

	/**
	 * execute
	 * 
	 * @param	XCube_Controller  &$controller
	 * 
	 * @return	void
	**/
	public function execute(/*** XCube_Controller ***/ &$controller)
	{
		if($this->_createAction() === false)
		{
			$this->doActionNotFoundError();
			die();
		}
	
		if($this->mAction->prepare() === false)
		{
			$this->doPreparationError();
			die();
		}
	
		if($this->mAction->hasPermission() === false)
		{
			$this->doPermissionError();
			die();
		}
	
		$viewStatus = (Playermap_Utils::getEnv('REQUEST_METHOD') == 'POST') ?
			$this->mAction->execute() :
			$this->mAction->getDefaultView();
	
		if(in_array($viewStatus,$this->_mAllowViewNames))
		{
			$methodName = 'executeView' . ucfirst($viewStatus);
			if(is_callable(array($this->mAction,$methodName)))
			{
				$render = $this->getRenderTarget();
				$this->mAction->$methodName($render);
				$render->setAttribute('xoops_pagetitle', $this->mAction->getPagetitle());
				$this->mAction->setHeaderScript();
			}
		}
	}

	/**
	 * _createAction
	 * 
	 * @param	void
	 * 
	 * @return	bool
	**/
	private function _createAction()
	{
		$root =& XCube_Root::getSingleton();
	
		if($this->mActionName == null)
		{
			$this->mActionName = $root->mContext->mRequest->getRequest('action');
			if($this->mActionName == null)
			{
				$this->mActionName = $this->_getDefaultActionName();
			}
		}
	
		if(!ctype_alnum($this->mActionName))
		{
			return false;
		}
	
		$fileName = ($this->mAdminFlag ? '/admin' : '')
			. '/actions/' . ucfirst($this->mActionName) . 'Action.class.php';
		switch(true)
		{
			case file_exists(
				$path = XOOPS_MODULE_PATH . '/' . $this->mXoopsModule->get('dirname') . $fileName
			):
				break;
			case file_exists(
				$path = PLAYERMAP_TRUST_PATH . '/' . $fileName
			):
				break;
			default:
				return false;
		}
	
		require_once $path;
	
		$className = 'Playermap_' . ($this->mAdminFlag ? 'Admin_' : '')
			. ucfirst($this->mActionName) . 'Action';
		if(class_exists($className))
		{
			$this->mAction = new $className();
		}
		if(!$this->mAction instanceof Playermap_AbstractAction)
		{
			return false;
		}
	
		return true;
	}

	/**
	 * doActionNotFoundError
	 * 
	 * @param	void
	 * 
	 * @return	void
	**/
	private function doActionNotFoundError()
	{
		/**
		 * Module.playermap.Global.Event.Exception.ActionNotFound
		 * 
		 * @param	string	$dirname
		 * 
		 * @return	void
		**/
		XCube_DelegateUtils::call('Module.playermap.Global.Event.Exception.ActionNotFound',$this->mAssetManager->mDirname);
		/**
		 * Module.{dirname}.Event.Exception.ActionNotFound
		 * 
		 * @param	void
		 * 
		 * @return	void
		**/
		XCube_DelegateUtils::call('Module.' . $this->mXoopsModule->get('dirname') . '.Event.Exception.ActionNotFound');
		$root =& XCube_Root::getSingleton();
		$root->mController->executeForward(XOOPS_URL);
	}

	/**
	 * doPreparationError
	 * 
	 * @param	void
	 * 
	 * @return	void
	**/
	private function doPreparationError()
	{
		/**
		 * Module.playermap.Global.Event.Exception.Preparation
		 * 
		 * @param	string	$dirname
		 * 
		 * @return	void
		**/
		XCube_DelegateUtils::call('Module.playermap.Global.Event.Exception.Preparation',$this->mAssetManager->mDirname);
		/**
		 * Module.{dirname}.Event.Exception.Preparation
		 * 
		 * @param	void
		 * 
		 * @return	void
		**/
		XCube_DelegateUtils::call('Module.' . $this->mXoopsModule->get('dirname') . '.Event.Exception.Preparation');
		$root =& XCube_Root::getSingleton();
		$root->mController->executeForward(XOOPS_URL);
	}

	/**
	 * doPermissionError
	 * 
	 * @param	void
	 * 
	 * @return	void
	**/
	private function doPermissionError()
	{
		/**
		 * Module.playermap.Global.Event.Exception.Permission
		 * 
		 * @param	string	$dirname
		 * 
		 * @return	void
		**/
		XCube_DelegateUtils::call('Module.playermap.Global.Event.Exception.Permission',$this->mAssetManager->mDirname);
		/**
		 * Module.{dirname}.Event.Exception.Permission
		 * 
		 * @param	void
		 * 
		 * @return	void
		**/
		XCube_DelegateUtils::call('Module.' . $this->mXoopsModule->get('dirname') . '.Event.Exception.Permission');
		$root =& XCube_Root::getSingleton();
		$root->mController->executeForward(XOOPS_URL);
	}
}

?>
