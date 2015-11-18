<?php

namespace Faderim\Ext\Field;

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *
 * @author Ricardo Schroeder <ricardo@magamobi.com.br>
 */
class TypeFieldFile extends TypeField
{

    public function setMultiple($multiple = true)
    {
        $this->setCustomProperty('multiple', $multiple);
    }

    public function getExtType()
    {
        return 'Ext.form.field.multiplefile';
    }

}
