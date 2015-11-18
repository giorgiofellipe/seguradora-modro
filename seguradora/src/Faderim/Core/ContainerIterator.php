<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Faderim\Core;

/**
 * Através de um componente/container percorre todos os seus filhos, netos, bisnetos, etc ...
 *
 * @author Rodrigo Cândido
 */
class ContainerIterator implements \RecursiveIterator
{

    private $childs;
    private $index = 0;
    private $container;

    public function __construct(\Faderim\Ext\Container $container)
    {
        $this->childs = $container->getChilds();
        $this->container = $container;
    }

    public function current()
    {
        return $this->childs[$this->index];
    }

    public function getChildren()
    {
        return $this->childs[$this->index]->getChilds();
    }

    public function hasChildren()
    {
        if ($this->childs[$this->index] instanceof \Faderim\Ext\Container) {
            return count($this->childs[$this->index]->getChilds());
        }
        return false;
    }

    public function key()
    {
        return $this->index;
    }

    public function next()
    {
        if ($this->hasChildren()) {
            $this->childs = array_merge($this->childs, $this->getChildren());
        }
        $this->index++;
    }

    public function rewind()
    {
        $this->index = 0;
        $this->childs = $this->container->getChilds();
    }

    public function valid()
    {
        return (isset($this->childs[$this->index]));
    }

}
