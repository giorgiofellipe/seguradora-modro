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
class TypeFieldTime extends TypeField
{

    public function __construct($name)
    {
        parent::__construct($name);
        $this->setCustomProperty('dateFormat', 'H:i');
        $this->setCustomProperty('format', 'H:i');
        //$this->setCustomProperty('editable', false);
    }

    public function getExtType()
    {
        return 'Ext.form.field.Time';
    }

    public function getExtTypeColumn()
    {
        return 'datecolumn';
    }

}
