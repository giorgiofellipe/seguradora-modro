<?php

namespace Seguradora\View\Form;

use Faderim\Ext\Field as Field;
use Faderim\Ext\Field\TypeField;

/**
 * Description of ApoliceForm
 *
 * @author Rodrigo Cândido
 */
class ApoliceForm extends \Faderim\Ext\AbstractForm
{

    public function __construct() {
        $this->labelWidth = 140;
        parent::__construct();
        
    }
    protected function createChilds()
    {
        //$this->setWidth(900);

        $id = new Field\FormField(TypeField::TYPE_NUMBER, 'id', 'Número', false, 13);
        $id->setReadOnly(true);        
        
        $dataIni = new Field\FormField(TypeField::TYPE_DATE, 'dataInicio', 'Início de Vigência', true);
        
        
        $dataFim = new Field\FormField(TypeField::TYPE_DATE, 'dataFim', 'Fim de Vigência', true);
        

        $cliente = new \Seguradora\View\Suggest\ClienteSuggest();
        $cliente->setRequired(true);
        
        $proprietario = new \Seguradora\View\Suggest\ClienteSuggest('proprietario','Proprietário');
        $proprietario->setRequired(true);
        
        $condutor = new \Seguradora\View\Suggest\ClienteSuggest('condutor','Condutor');
        $condutor->setRequired(true);
        
        $tipoSeguro = new \Seguradora\View\Suggest\TipoSeguroSuggest();
        $tipoSeguro->setRequired(true);
        
        $tipoSeguroRegiao = new Field\FormField(TypeField::TYPE_LIST, 'tipoSeguroRegiao', 'Região', false);        
        $tipoSeguroRegiao->getTypeField()->getLocalStore()->setEnumerator(new \Faderim\Util\Enumerator(array()));
        
        $descricao = new Field\FormField(TypeField::TYPE_TEXT_AREA, 'descricaoBem', 'Descrição do Bem', true);        
        
        $valorBem = new Field\FormField(TypeField::TYPE_NUMBER, 'valorBem', 'Valor do Bem', true, 10);
        $valorBem->getTypeField()->setDecimal(2);
        
        
        $situacao = new Field\FormField(TypeField::TYPE_LIST, 'situacao', 'Situação', true);        
        $situacao->getTypeField()->getLocalStore()->setEnumerator(\Seguradora\Model\Apolice::getSituacaoList());
        $situacao->setModelValue(\Seguradora\Model\Apolice::SITUACAO_PENDENTE);
        
        $bonus = new Field\FormField(TypeField::TYPE_LIST, 'bonus', 'Bônus', false);        
        $bonus->getTypeField()->getLocalStore()->setEnumerator(\Seguradora\Model\Apolice::getBonusList());
        
        $this->setExtendedFromJs('Seguradora/View/Form/Js/ApoliceForm');

        $this->addChilds($id, $dataIni, $dataFim,$cliente,$proprietario,$condutor,$tipoSeguro,$tipoSeguroRegiao,$descricao,$valorBem,$situacao,$bonus);
    }

    protected function getFormName()
    {
        return 'form_apolice';
    }

}