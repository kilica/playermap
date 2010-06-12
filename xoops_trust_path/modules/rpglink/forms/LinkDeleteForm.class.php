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
 * Rpglink_LinkDeleteForm
**/
class Rpglink_LinkDeleteForm extends XCube_ActionForm
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
        return "module.rpglink.LinkDeleteForm.TOKEN";
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
        $this->mFormProperties['link_id'] = new XCube_IntProperty('link_id');
    
        //
        // Set field properties
        //
        $this->mFieldProperties['link_id'] = new XCube_FieldProperty($this);
        $this->mFieldProperties['link_id']->setDependsByArray(array('required'));
        $this->mFieldProperties['link_id']->addMessage('required', _MD_RPGLINK_ERROR_REQUIRED, _MD_RPGLINK_LANG_LINK_ID);
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
        $this->set('link_id', $obj->get('link_id'));
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
        $obj->set('link_id', $this->get('link_id'));
    }
}

?>
