<?php

namespace Seguradora\View\Form;

use Faderim\Ext\Field as Field;
use Faderim\Ext\Field\TypeField;

/**
 * Description of PerguntaForm
 *
 * @author Giorgio Fellipe
 */
class PerguntaForm extends \Faderim\Ext\AbstractForm
{

    protected function createChilds()
    {
        $this->setWidth(900);

        $id = new Field\FormField(TypeField::TYPE_NUMBER, 'id', 'Código', false, 13);
        $id->setReadOnly(true);
        $id->setLabelWidth(200);

        $tipoPergunta = new \Seguradora\View\Suggest\TipoPerguntaSuggest();
        $tipoPergunta->setRequired(true);
        $tipoPergunta->setLabelWidth(200);

        $descricao = new Field\FormField(TypeField::TYPE_TEXT, 'descricao', 'Descrição', true, 100);
        $descricao->setLabelWidth(200);

        $porcentagem = new Field\FormField(TypeField::TYPE_NUMBER, 'porcentagem', 'Porcentagem', true, 5);
        $porcentagem->getTypeField()->setDecimal(2);
        $porcentagem->setLabelWidth(200);

        $formaAplicarPorcentagem = new Field\FormField(TypeField::TYPE_LIST, 'formaAplicarPorcentagem', 'Forma de Aplicar Porcentagem', true);
        $formaAplicarPorcentagem->getTypeField()->getLocalStore()->setEnumerator(\Seguradora\Model\Pergunta::getFormaAplicarPorcentagemLista());
        $formaAplicarPorcentagem->setLabelWidth(200);

        $this->addChilds($id, $tipoPergunta, $descricao, $porcentagem, $formaAplicarPorcentagem);
    }

    protected function getFormName()
    {
        return 'form_pergunta';
    }

}
