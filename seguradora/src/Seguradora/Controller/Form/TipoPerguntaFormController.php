<?php

namespace Seguradora\Controller\Form;

/**
 * Description of TipoPerguntaFormController
 *
 * @author Giorgio Fellipe
 */
class TipoPerguntaFormController extends \Faderim\Framework\Controller\BaseFormController
{

    protected function createInstanceModel()
    {
        return new \Seguradora\Model\TipoPergunta();
    }

    protected function createInstanceView()
    {
        return new \Seguradora\View\Form\TipoPerguntaForm();
    }

}
