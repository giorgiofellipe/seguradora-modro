<?php

namespace Faderim\Ext;

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AbstractViewPort
 *
 * @author Ricardo Schroeder
 */
abstract class AbstractViewPort extends ViewPort
{

    public function __construct()
    {
        parent::__construct($this->getViewPortName());
        $this->createChilds();
    }

    abstract protected function getViewPortName();

    abstract protected function createChilds();
}
