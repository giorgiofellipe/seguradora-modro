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
class Container extends Component
{

    const LAYOUT_COLUMN = 'column';
    const LAYOUT_BORDER = 'border';
    const LAYOUT_ANCHOR = 'anchor';
    const LAYOUT_TABLE = 'table';
    const LAYOUT_FIT = 'fit';
    const LAYOUT_HBOX = 'hbox';
    const LAYOUT_VBOX = 'vbox';

    protected $itemsProp = "items";

    public function addChild($Child)
    {
        $items = $this->getChilds();
        if (is_null($items)) {
            $items = Array();
        }
        $items[] = $Child;
        $Child->setParent($this);
        $this->setProperty($this->itemsProp, $items);
    }

    public function findChild($name)
    {
        $aItens = $this->getChilds();
        foreach ($aItens as $item) {
            if ($item->getName() == $name) {
                return $item;
            } if ($item instanceof Container) {
                $item = $item->findChild($name);
                if ($item !== null) {
                    return $item;
                }
            }
        }
        return null;
    }

    public function getChilds()
    {
        $childs = $this->getProperty($this->itemsProp);
        return $childs === null ? Array() : $childs;
    }

    public function addChilds()
    {
        $args = func_get_args();
        foreach ($args as $argAtual) {
            $this->addChild($argAtual);
        }
    }

    public function setLayout($layout)
    {
        $this->setProperty('layout', $layout);
    }

    public function setLayoutTable($columns)
    {
        $this->setLayout(Array('type' => self::LAYOUT_TABLE, 'columns' => $columns));
    }

    public function setLayoutStretch($layout = self::LAYOUT_VBOX)
    {
        $this->setLayout(Array('type' => $layout, 'align' => 'stretch'));
    }

    protected function getExtClassName()
    {
        return 'Ext.container.Container';
    }

    /**
     * @return ComponentLoader
     */
    public function getLoader()
    {
        $oLoader = new ComponentLoader();
        $this->setProperty('loader', $oLoader);
        return $oLoader;
    }

}
