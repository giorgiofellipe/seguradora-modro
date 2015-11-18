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
class TypeFieldEmail extends TypeField
{

    public function __construct($name)
    {
        parent::__construct($name);
        $this->setCustomProperty('vtype', 'email');
    }

}
