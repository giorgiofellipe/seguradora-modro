<?php

namespace Faderim\Ext;

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Container
 *
 * @author Ricardo
 */
class Button extends Component
{

    const ICON_CLASS_ADD = 'icon-add';
    const ICON_CLASS_EDIT = 'icon-edit';
    const ICON_CLASS_DELETE = 'icon-delete';

    public function __construct($name, $title = 'Button')
    {
        parent::__construct($name);
        $this->setTitle($title);
    }

    protected function getExtClassName()
    {
        return 'Ext.Button';
    }

    public function setTitle($title)
    {
        $this->setProperty('text', $title);
    }

    public function setIconClass($class)
    {
        $this->setProperty('iconCls', $class);
    }

}
