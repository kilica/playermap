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

require_once XOOPS_ROOT_PATH . '/core/XCube_ActionForm.class.php';
require_once XOOPS_MODULE_PATH . '/legacy/class/Legacy_Validator.class.php';

/**
 * Trpg_RpgDeleteForm
**/
class Trpg_RpgDeleteForm extends XCube_ActionForm
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
        return "module.trpg.RpgDeleteForm.TOKEN";
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
        $this->mFormProperties['rpg_id'] = new XCube_IntProperty('rpg_id');
    
        //
        // Set field properties
        //
        $this->mFieldProperties['rpg_id'] = new XCube_FieldProperty($this);
        $this->mFieldProperties['rpg_id']->setDependsByArray(array('required'));
        $this->mFieldProperties['rpg_id']->addMessage('required', _MD_TRPG_ERROR_REQUIRED, _MD_TRPG_LANG_RPG_ID);
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
        $this->set('rpg_id', $obj->get('rpg_id'));
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
        $obj->set('rpg_id', $this->get('rpg_id'));
    }
}

?>
