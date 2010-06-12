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
 * Trpg_BookDeleteForm
**/
class Trpg_BookDeleteForm extends XCube_ActionForm
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
        return "module.trpg.BookDeleteForm.TOKEN";
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
        $this->mFormProperties['book_id'] = new XCube_IntProperty('book_id');
    
        //
        // Set field properties
        //
        $this->mFieldProperties['book_id'] = new XCube_FieldProperty($this);
        $this->mFieldProperties['book_id']->setDependsByArray(array('required'));
        $this->mFieldProperties['book_id']->addMessage('required', _MD_TRPG_ERROR_REQUIRED, _MD_TRPG_LANG_BOOK_ID);
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
        $this->set('book_id', $obj->get('book_id'));
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
        $obj->set('book_id', $this->get('book_id'));
    }
}

?>
