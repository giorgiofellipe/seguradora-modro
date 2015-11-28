<?php

namespace Seguradora\View\Form;

use Faderim\Ext\Field as Field;
use Faderim\Ext\Field\TypeField;

/**
 * Description of TipoPerguntaForm
 *
 * @author Giorgio Fellipe
 */
class TipoPerguntaForm extends \Faderim\Ext\AbstractForm
{

    protected function createChilds()
    {
        $this->setWidth(900);
        $id = new Field\FormField(TypeField::TYPE_NUMBER, 'id', 'Código', false, 13);
        $id->setReadOnly(true);
        $descricao = new Field\FormField(TypeField::TYPE_TEXT, 'descricao', 'Descrição', true, 100);
        $this->addChilds($id, $descricao);
    }

    protected function getFormName()
    {
        return 'form_tipo_pergunta';
    }

}
