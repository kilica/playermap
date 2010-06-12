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

require_once XOOPS_ROOT_PATH . '/core/XCube_ActionForm.class.php';
require_once XOOPS_MODULE_PATH . '/legacy/class/Legacy_Validator.class.php';

/**
 * Playermap_FavrpgDeleteForm
**/
class Playermap_FavrpgDeleteForm extends XCube_ActionForm
{
    /**
     * getTokenName
     * 
     * @param   void
     * 
     * @return  string
    **/
    public function getTokenName()
    {
        return "module.playermap.FavrpgDeleteForm.TOKEN";
    }

    /**
     * prepare
     * 
     * @param   void
     * 
     * @return  void
    **/
    public function prepare()
    {
        //
        // Set form properties
        //
        $this->mFormProperties['favrpg_id'] = new XCube_IntProperty('favrpg_id');
    
        //
        // Set field properties
        //
        $this->mFieldProperties['favrpg_id'] = new XCube_FieldProperty($this);
        $this->mFieldProperties['favrpg_id']->setDependsByArray(array('required'));
        $this->mFieldProperties['favrpg_id']->addMessage('required', _MD_PLAYERMAP_ERROR_REQUIRED, _MD_PLAYERMAP_LANG_FAVRPG_ID);
    }

    /**
     * load
     * 
     * @param   XoopsSimpleObject  &$obj
     * 
     * @return  void
    **/
    public function load(/*** XoopsSimpleObject ***/ &$obj)
    {
        $this->set('favrpg_id', $obj->get('favrpg_id'));
    }

    /**
     * update
     * 
     * @param   XoopsSimpleObject  &$obj
     * 
     * @return  void
    **/
    public function update(/*** XoopsSimpleObject ***/ &$obj)
    {
        $obj->set('favrpg_id', $this->get('favrpg_id'));
    }
}

?>
