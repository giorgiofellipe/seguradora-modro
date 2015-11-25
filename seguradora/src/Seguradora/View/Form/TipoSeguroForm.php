<?php

namespace Seguradora\View\Form;

use Faderim\Ext\Field as Field;
use Faderim\Ext\Field\TypeField;

/**
 * Description of TipoSeguroForm
 *
 * @author Giorgio Fellipe
 */
class TipoSeguroForm extends \Faderim\Ext\AbstractForm
{

    protected function createChilds()
    {
        $this->setWidth(900);
        $id = new Field\FormField(TypeField::TYPE_NUMBER, 'id', 'Código', false, 13);
        $id->setReadOnly(true);
        $descricao = new Field\FormField(TypeField::TYPE_TEXT, 'descricao', 'Descrição', true, 100);
        $porcentagemFranquia = new Field\FormField(TypeField::TYPE_NUMBER, 'porcentagemFranquia', 'Porcentagem da Franquia', true, 5);
        $porcentagemFranquia->getTypeField()->setDecimal(2);
        $this->addChilds($id, $descricao, $porcentagemFranquia);
    }

    protected function getFormName()
    {
        return 'form_tipo_seguro';
    }

}
