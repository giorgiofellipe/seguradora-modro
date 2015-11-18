<?php

namespace Seguradora\Controller\Form;

/**
 * Description of UsuarioForm
 *
 * @author Rodrigo Cândido
 */
class UsuarioFormController extends \Faderim\Framework\Controller\BaseFormController {

    protected function createInstanceModel() {
        return new \Seguradora\Model\Usuario();
    }

    protected function createInstanceView() {
        return new \Seguradora\View\Form\UsuarioForm();
    }
    
    protected function beanForm() {
        parent::beanForm();
        $this->getView()->findChild('senha')->setModelValue('');
    }

}
