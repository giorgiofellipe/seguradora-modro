<?php

namespace Seguradora\Controller\Grid;

/**
 * Description of ClienteGridController
 *
 * @author Rodrigo Cândido
 */
class ClienteGridController extends \Faderim\Framework\Controller\BaseListController
{

    protected function createInstanceView()
    {
        return new \Seguradora\View\Grid\ClienteGrid();
    }

    protected function createInstanceRepository()
    {
        return $this->getEntityManager()->getRepository('Seguradora\Model\Cliente');
    }

}
