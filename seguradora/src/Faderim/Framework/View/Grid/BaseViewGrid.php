<?php

namespace Faderim\Framework\View\Grid;

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of BaseViewForm
 *
 * @author Ricardo
 */
abstract class BaseViewGrid extends \Faderim\Ext\GridPanel
{

    protected $rowAction = Array();
    protected $action = Array();
    protected $pageSize = 20;

    protected function getExtClassName()
    {
        return 'Faderim.grid.Panel';
    }

    public function __construct()
    {
        //parent::__construct($this->getPageName() . '_grid');
        parent::__construct(null);
        $this->createComponents();
        $link = new \Faderim\Core\Link($this->getDefaultRouterName(), 'getDataAction');
        if ($this->getStore() instanceof \Faderim\Ext\Store\JsonStore) {
            $this->getStore()->setUrl($link->getUrl());
        }
    }

    protected function addRowAction($title, $routerName, $action = \Faderim\Ext\Grid\ActionGrid::TYPE_WINDOW)
    {
        if ($routerName === null) {
            $routerName = $this->getPageName();
        }
        $action = new \Faderim\Ext\Grid\ActionGrid($title, $routerName, $action);
        $this->rowAction[] = $action;
        return $action;
    }

    protected function addAction($title, $routerName, $action = \Faderim\Ext\Grid\ActionGrid::TYPE_WINDOW)
    {
        if ($routerName === null) {
            $routerName = $this->getPageName();
        }
        $action = new \Faderim\Ext\Grid\ActionGrid($title, $routerName, $action);
        $this->action[] = $action;
        return $action;
    }

    protected function getExtProperties()
    {
        $this->setProperty('rowAction', $this->rowAction);
        $this->setProperty('action', $this->action);
        $this->setProperty('pageSize', $this->pageSize);
        //$this->setProperty('sorters', Array(Array('property' => 'codigo', 'direction' => 'DESC')));
        return parent::getExtProperties();
    }

    public function getDefaultRouterName()
    {
        return $this->getPageName();
    }

    public function setPageSize($pageSize)
    {
        $this->pageSize = $pageSize;
    }

    public function setSortInitial($column, $direction = 'ASC')
    {
        $this->getStore()->setSort($column, strtoupper($direction));
    }

    abstract protected function getPageName();

    abstract protected function createComponents();

    public function addActionAdd($name)
    {
        return $this->addAction('Incluir', $name . '_add');
    }

    public function addActionEdit($name)
    {
        return $this->addRowAction('Alterar', $name . '_edit');
    }

    public function addActionView($name)
    {
        return $this->addRowAction('Visualizar', $name . '_view');
    }

    public function addActionDelete($name)
    {
        $delete = $this->addRowAction('Excluir', $name . '_delete');
        $delete->setMultiple(true);
        $delete->setType(\Faderim\Ext\Grid\ActionGrid::TYPE_HIDE);
        return $delete;
    }

}
