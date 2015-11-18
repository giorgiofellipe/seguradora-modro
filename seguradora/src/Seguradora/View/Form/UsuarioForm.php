<?php

namespace Seguradora\View\Form;

use Faderim\Ext\Field as Field;
use Faderim\Ext\Field\TypeField;

/**
 * Form Usuário
 * @author Rodrigo Cândido
 */
class UsuarioForm extends \Faderim\Ext\AbstractForm {

    protected function createChilds() {
        $this->setWidth(900);
        $id = new Field\FormField(TypeField::TYPE_NUMBER, 'id', 'Código', false, 13);
        $id->setReadOnly(true);
        $nome = new Field\FormField(TypeField::TYPE_TEXT, 'nome', 'Nome', true, 150);
        $login = new Field\FormField(TypeField::TYPE_TEXT, 'login', 'Login', true, 100);
        $senha = new Field\FormField(TypeField::TYPE_TEXT, 'senha', 'Senha', true, 50);
        $this->addChilds($id, $nome, $login, $senha);
    }

    protected function getFormName() {
        return 'form_usuario';
    }

}
