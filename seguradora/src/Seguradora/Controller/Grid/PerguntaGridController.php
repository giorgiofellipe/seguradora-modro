<?php

namespace Seguradora\Controller\Grid;

/**
 * Description of PerguntaGridController
 *
 * @author Giorgio Fellipe
 */
class PerguntaGridController extends \Faderim\Framework\Controller\BaseListController
{

    protected function createInstanceView()
    {
        return new \Seguradora\View\Grid\PerguntaGrid();
    }

    protected function createInstanceRepository()
    {
        return $this->getEntityManager()->getRepository('Seguradora\Model\Pergunta');
    }

}
