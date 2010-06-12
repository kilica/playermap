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

require_once XOOPS_ROOT_PATH . '/core/XCube_ActionForm.class.php';
require_once XOOPS_MODULE_PATH . '/legacy/class/Legacy_Validator.class.php';

/**
 * Rpglink_LrpgDeleteForm
**/
class Rpglink_LrpgDeleteForm extends XCube_ActionForm
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
        return "module.rpglink.LrpgDeleteForm.TOKEN";
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
        $this->mFormProperties['lrpg_id'] = new XCube_IntProperty('lrpg_id');
    
        //
        // Set field properties
        //
        $this->mFieldProperties['lrpg_id'] = new XCube_FieldProperty($this);
        $this->mFieldProperties['lrpg_id']->setDependsByArray(array('required'));
        $this->mFieldProperties['lrpg_id']->addMessage('required', _MD_RPGLINK_ERROR_REQUIRED, _MD_RPGLINK_LANG_LRPG_ID);
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
        $this->set('lrpg_id', $obj->get('lrpg_id'));
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
        $obj->set('lrpg_id', $this->get('lrpg_id'));
    }
}

?>
