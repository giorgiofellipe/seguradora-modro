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
        $id->setLabelWidth(140);
        $descricao = new Field\FormField(TypeField::TYPE_TEXT, 'descricao', 'Descrição', true, 100);
        $descricao->setLabelWidth(140);
        $porcentagemFranquia = new Field\FormField(TypeField::TYPE_NUMBER, 'porcentagemFranquia', 'Base Franquia (%)', true, 5);
        $porcentagemFranquia->getTypeField()->setDecimal(2);
        $porcentagemFranquia->setLabelWidth(140);
        $this->addChilds($id, $descricao, $porcentagemFranquia,  $this->createTipoSeguroRegiao());
    }
    
    protected function createTipoSeguroRegiao(){
        $tipoSeguroRegiao = new \Faderim\Ext\GridForm('tipoSeguroRegiao');
        $tipoSeguroRegiao->setLinhasIniciais(1);
        $tipoSeguroRegiao->setTitle("Percentual sobre o valor base do bem por regiãopara o valor prêmio");        
        $tipoSeguroRegiao->setLayoutStretch(self::LAYOUT_VBOX);
        
        $linha = new \Faderim\Ext\Container('linha');
        $linha->setLayoutStretch(self::LAYOUT_HBOX);
        
        $id = new Field\FormField(TypeField::TYPE_TEXT, 'id', 'ID', false, 13);
        $id->setReadOnly(true);
        $id->setHidden();        
        $porcentagem= new Field\FormField(TypeField::TYPE_NUMBER, 'porcentagem', 'Percentagem', true, 5);
        $porcentagem->getTypeField()->setDecimal(2);        
        $regiao = new Field\FormField(TypeField::TYPE_TEXT, 'regiao', 'Região', true, 150);
        $regiao->setFlexSize();
        
        $linha->addChilds($id,$porcentagem,$regiao);
        $tipoSeguroRegiao->addChild($linha);
        return $tipoSeguroRegiao;
    }

    protected function getFormName()
    {
        return 'form_tipo_seguro';
    }

}
