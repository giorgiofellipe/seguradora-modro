<?php

namespace Seguradora\Controller\Form;

/**
 * Description of ApoliceFormController
 *
 * @author Rodrigo Cândido
 */
class ApoliceFormController extends \Faderim\Framework\Controller\BaseFormController
{

    protected function createInstanceModel()
    {
        return new \Seguradora\Model\Apolice();
    }

    protected function createInstanceView()
    {
        return new \Seguradora\View\Form\ApoliceForm();
    }

}
