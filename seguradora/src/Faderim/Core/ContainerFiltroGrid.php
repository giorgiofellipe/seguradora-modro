<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Faderim\Core;

/**
 * Description of ContainerFiltroGrid
 *
 * @author Rodrigo Cândido <rodrigo@magamobi.com.br>
 */
class ContainerFiltroGrid implements \Faderim\Json\JsonSerializable
{

    /**
     *
     * @var FiltroGrid[]
     */
    protected $filtros = Array();

    public function addFiltro(FiltroGrid $filtro)
    {
        $this->filtros[] = $filtro;
    }

    public function findFiltro($filtroNome)
    {
        foreach ($this->filtros as $filtro) {
            if ($filtro->getNome() == $filtroNome) {
                return $filtro;
            }
        }
        return null;
    }

    public static function createContainerFiltroFromRequest($request, $container = null)
    {

        $container = ($container == null) ? new ContainerFiltroGrid() : $container;
        $filters = $request->getJsonParameter('q', Array());
        foreach ($filters as $filter) {
            $filtro = new FiltroGrid();
            $filtro->setOperador($filter['p']);
            $filtro->setNome($filter['id']);
            $filtro->setValor($filter['v']);
            $container->addFiltro($filtro);
        }
        return $container;
    }

    public function getJsonFormat()
    {
        return $this->filtros;
    }

    public function getFiltros()
    {
        return $this->filtros;
    }

}
