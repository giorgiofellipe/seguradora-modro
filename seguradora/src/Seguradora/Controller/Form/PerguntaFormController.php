<?php

namespace Seguradora\Controller\Form;

/**
 * Description of PerguntaFormController
 *
 * @author Giorgio Fellipe
 */
class PerguntaFormController extends \Faderim\Framework\Controller\BaseFormController
{

    protected function createInstanceModel()
    {
        return new \Seguradora\Model\Pergunta();
    }

    protected function createInstanceView()
    {
        return new \Seguradora\View\Form\PerguntaForm();
    }

}
