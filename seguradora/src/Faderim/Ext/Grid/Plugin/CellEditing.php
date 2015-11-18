<?php
namespace Faderim\Ext\Grid\Plugin;
use Faderim\Ext\Component;
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CellEditing
 *
 * @author Ricardo Schroeder
 */
class CellEditing extends Component
{
    public function __construct()
    {
        parent::__construct(null);
    }
    
    protected function setDefaultProperties()
    {
        $this->setProperty('clicksToEdit', 2);
    }
    
     protected function getExtClassName() {
        return 'Ext.grid.plugin.CellEditing';
    }

}
