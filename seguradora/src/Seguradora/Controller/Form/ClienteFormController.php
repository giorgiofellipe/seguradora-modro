<?php

namespace Seguradora\Controller\Form;

/**
 * Description of ClienteFormController
 *
 * @author Rodrigo Cândido
 */
class ClienteFormController extends \Faderim\Framework\Controller\BaseFormController
{

    protected function createInstanceModel()
    {
        return new \Seguradora\Model\Cliente();
    }

    protected function createInstanceView()
    {
        return new \Seguradora\View\Form\ClienteForm();
    }

}
