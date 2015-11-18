<?php

namespace Faderim\Ext\Store;

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class GridJsonStore extends JsonStore
{

    protected function getExtClassName()
    {
        return 'Faderim.data.GridJsonStore';
    }

    public function setFiltersFixed(\Faderim\Core\ContainerFiltroGrid $filtros)
    {
        $this->setProperty('filterFixed', $filtros);
    }

}
