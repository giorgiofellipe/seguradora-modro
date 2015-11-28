<?php

namespace Seguradora\Controller\Form;

/**
 * Description of TipoSeguroFormController
 *
 * @author Giorgio Fellipe
 */
class TipoSeguroFormController extends \Faderim\Framework\Controller\BaseFormController
{

    protected function createInstanceModel()
    {
        return new \Seguradora\Model\TipoSeguro();
    }

    protected function createInstanceView()
    {
        return new \Seguradora\View\Form\TipoSeguroForm();
    }

}
