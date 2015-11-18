<?php

namespace Faderim\Ext\Field;

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TextTypeField
 *
 * @author Rick
 */
class TypeFieldNumber extends TypeField
{

    public function __construct($name)
    {
        parent::__construct($name);
        $this->setCustomProperty('hideTrigger', true);
        //$this->setCustomProperty('format', '');
    }

    public function getExtType()
    {
        return 'Ext.form.field.Number';
    }

    /*
      public function getExtTypeColumn()
      {
      return 'numbercolumn';
      } */
}
