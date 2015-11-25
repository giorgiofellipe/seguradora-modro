<?php

namespace Seguradora\Controller\Grid;

/**
 * Description of TipoSeguroGridController
 *
 * @author Giorgio Fellipe
 */
class TipoSeguroGridController extends \Faderim\Framework\Controller\BaseListController
{

    protected function createInstanceView()
    {
        return new \Seguradora\View\Grid\TipoSeguroGrid();
    }

    protected function createInstanceRepository()
    {
        return $this->getEntityManager()->getRepository('Seguradora\Model\TipoSeguro');
    }

}
