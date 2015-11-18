<?php

namespace Faderim\Ext;

/**
 * Description of GridPanel
 *
 * @author Ricardo
 */
class GridPanel extends Panel
{

    protected $itemsProp = "columns";

    /**
     * @var Store\GridJsonStore
     */
    protected $Store;
    protected $plugins = Array();
    protected $dockedItems = Array();
    protected $filterFixed = null;

    protected function getExtClassName()
    {
        return 'Ext.grid.Panel';
    }

    public function addChild($Child)
    {
        parent::addChild($Child);
        if ($Child instanceof Field\GridField) {
            $this->Store->addField($Child->getTypeField());
        } elseif ($Child instanceof Field\GroupField) {
            foreach ($Child->getChilds() as $newChild) {
                $this->Store->addField($newChild->getTypeField());
            }
        }
        return $Child;
    }

    protected function setDefaultProperties()
    {
        $this->Store = $this->getStore();
        $this->setProperty('store', $this->Store);
        $this->setProperty('columnLines', true);
    }

    protected function getExtProperties()
    {
        $this->setProperty('plugins', $this->plugins);
        $this->setProperty('dockedItems', $this->dockedItems);
        if ($this->filterFixed !== null) {
            $this->Store->setFiltersFixed($this->filterFixed);
        }
        return parent::getExtProperties();
    }

    public function getStore()
    {
        if (!isset($this->Store)) {
            $this->Store = $this->getInstanceStore();
        }
        return $this->Store;
    }

    protected function getInstanceStore()
    {
        return new Store\GridJsonStore();
    }

    public function addPlugin($plugin)
    {
        $this->plugins[] = $plugin;
    }

    public function addDockedItem($item)
    {
        $this->dockedItems[] = $item;
    }

    public function setGroup($name)
    {
        $this->Store->setGroup($name);
        $this->setProperty('features', Array(
            Array('id' => 'group',
                'ftype' => 'groupingsummary',
                'hideGroupedHeader' => true,
                'enableGroupingMenu' => true,
                'groupHeaderTpls' => '{name}')
        ));
    }

    public function setRowClassListener(EventListener $evt)
    {
        $this->setProperty('viewConfig', Array('getRowClass' => $evt));
    }

    public function addFilterFixed($nome, $valor, $operador = '=')
    {
        $this->getFilterFixed()->addFiltro(new \Faderim\Core\FiltroGrid($nome, $operador, $valor));
    }

    public function getFilterFixed()
    {
        if ($this->filterFixed == null) {
            $this->filterFixed = new \Faderim\Core\ContainerFiltroGrid();
        }
        return $this->filterFixed;
    }

}
