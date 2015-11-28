<?php

namespace Seguradora\Controller\Grid;

/**
 * Description of ApoliceList
 *
 * @author Rodrigo Cândido
 */
class ApoliceGridController extends \Faderim\Framework\Controller\BaseListController {

    protected function createInstanceView() {
        return new \Seguradora\View\Grid\ApoliceGrid();
    }

    protected function createInstanceRepository() {
        return $this->getEntityManager()->getRepository('Seguradora\Model\Apolice');
    }

}
