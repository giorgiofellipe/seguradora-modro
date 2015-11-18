<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Faderim\Framework\Controller;

/**
 * Description of PageListController
 *
 * @author Rodrigo
 */
class RouterListController extends \Faderim\Framework\Controller\BaseListController
{

    protected function createInstanceRepository()
    {
        return $this->getEntityManager()->getRepository('Faderim\Framework\Model\Router');
    }

    protected function createInstanceView()
    {
        return new \Faderim\Framework\View\Grid\RouterGrid();
    }

}
