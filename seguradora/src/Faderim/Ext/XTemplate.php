<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Faderim\Ext;

/**
 * Description of XTemplate
 *
 * @author ricardo
 */
class XTemplate extends Base
{

    public function __construct($template = '')
    {
        $this->properties = $template;
    }

    protected function getExtClassName()
    {
        return 'Ext.XTemplate';
    }

}
