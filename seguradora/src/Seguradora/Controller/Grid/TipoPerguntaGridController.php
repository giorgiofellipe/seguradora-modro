<?php

namespace Seguradora\Controller\Grid;

/**
 * Description of TipoPerguntaGridController
 *
 * @author Giorgio Fellipe
 */
class TipoPerguntaGridController extends \Faderim\Framework\Controller\BaseListController
{

    protected function createInstanceView()
    {
        return new \Seguradora\View\Grid\TipoPerguntaGrid();
    }

    protected function createInstanceRepository()
    {
        return $this->getEntityManager()->getRepository('Seguradora\Model\TipoPergunta');
    }

}
