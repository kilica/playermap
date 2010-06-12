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
 * Rpglink_UpdateDeleteForm
**/
class Rpglink_UpdateDeleteForm extends XCube_ActionForm
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
        return "module.rpglink.UpdateDeleteForm.TOKEN";
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
        $this->mFormProperties['update_id'] = new XCube_IntProperty('update_id');
    
        //
        // Set field properties
        //
        $this->mFieldProperties['update_id'] = new XCube_FieldProperty($this);
        $this->mFieldProperties['update_id']->setDependsByArray(array('required'));
        $this->mFieldProperties['update_id']->addMessage('required', _MD_RPGLINK_ERROR_REQUIRED, _MD_RPGLINK_LANG_UPDATE_ID);
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
        $this->set('update_id', $obj->get('update_id'));
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
        $obj->set('update_id', $this->get('update_id'));
    }
}

?>
