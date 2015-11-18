<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Faderim\Framework\Controller;

/**
 * Description of ListBaseController
 *
 * @author Rodrigo Cândido
 */
abstract class BaseListController extends BaseController
{

    private $Repository = null;
    private $View = null;

    /**
     * @return \Faderim\Framework\View\Grid\BaseViewGrid Retorna a Instância do Grid de Consulta
     */
    abstract protected function createInstanceView();

    abstract protected function createInstanceRepository();

    /**
     * Retorna a Instância da QueryBuilder par a busca de informações
     * @return type Description
     */
    protected function getQuery()
    {
        return $this->getRepository()->getQueryBuilder();
    }

    /**
     *
     * @return \Doctrine\ORM\EntityRepository
     */
    public function getRepository()
    {
        if ($this->Repository === null) {
            $this->Repository = $this->createInstanceRepository();
        }
        return $this->Repository;
    }

    /**
     *
     * @return \Faderim\Framework\View\Grid\BaseViewGrid
     */
    public function getView()
    {
        if ($this->View === null) {
            $this->View = $this->createInstanceView();
        }
        return $this->View;
    }

    public function getDataAction()
    {
        $jsonGrid = new \Faderim\Core\GridJsonResponse();
        $jsonGrid->setParameterFromRequest($this->getRequest());
        $jsonGrid->setFilters(\Faderim\Core\ContainerFiltroGrid::createContainerFiltroFromRequest($this->getRequest(), $this->getView()->getFilterFixed()));
        $jsonGrid->setFields($this->view()->getChilds());
        $jsonGrid->setQuery($this->getQuery());
        return $jsonGrid->getResponse();
    }

    public function getDataActionSuggest()
    {
        return $this->getDataAction();
    }

    public function view()
    {
        return $this->getView();
    }

}
