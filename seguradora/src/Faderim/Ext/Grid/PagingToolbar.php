<?php

namespace Faderim\Ext\Grid;

/**
 * Description of PagingToolbar
 *
 * @author Ricardo Schroeder
 */
class PagingToolbar extends \Faderim\Ext\Component
{

    protected function setDefaultProperties()
    {
        parent::setDefaultProperties();
        $this->setProperty('displayInfo', true);
        //$this->setProperty('pageSize', 10);
        //$this->setProperty('displayMsg', 'Mostrando registro {0} - {1} de {2}');
    }

    protected function getExtClassName()
    {
        return 'Ext.PagingToolbar';
    }

}

