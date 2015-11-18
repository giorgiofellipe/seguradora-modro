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
class TypeFieldColor extends TypeField
{

    public function getExtType()
    {
        return 'Faderim.form.field.ColorPicker';
    }

    public function getExtTypeColumn()
    {
        return 'colorcolumn';
    }

}
