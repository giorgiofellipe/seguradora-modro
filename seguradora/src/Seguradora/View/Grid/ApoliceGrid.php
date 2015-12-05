<?php

namespace Seguradora\View\Grid;

use Faderim\Ext\Field\GridField;
use Faderim\Ext\Field\TypeField;

/**
 * Description of PerguntaGrid
 *
 * @author Rodrigo Cândido
 */
class ApoliceGrid extends \Faderim\Framework\View\Grid\BaseViewGrid
{

    protected function createComponents()
    {
        $this->addChild(new GridField(TypeField::TYPE_NUMBER, 'id', 'Número', 0.1, true));
        $this->addChild(new GridField(TypeField::TYPE_TEXT, 'descricaoBem', 'Bem', 0.2, true));
        $this->addChild(new GridField(TypeField::TYPE_TEXT, 'cliente/nome', 'Cliente', 0.4, true));
        $this->addChild(new GridField(TypeField::TYPE_DATE, 'dataInicio', 'Data Início', 0.2, true));
        $this->addChild(new GridField(TypeField::TYPE_DATE, 'dataFim', 'Data Fim', 0.2, true));        
        $situacao = $this->addChild(new GridField(TypeField::TYPE_LIST, 'situacao', 'Situação', 0.4, true));
        $situacao->getTypeField()->getLocalStore()->setEnumerator(\Seguradora\Model\Apolice::getSituacaoList());
        
        $this->addActionAdd('seg_apolice');
        $this->addAction('Relatórios Gerenciais', 'seg_report_printer');        
        $this->addActionEdit('seg_apolice');
        $this->addActionDelete('seg_apolice');
        $this->addRowAction('Responder Questionário', 'seg_pergunta_answer');
        $imprimir =$this->addRowAction('Imprimir', 'seg_apolice_printer');
        $imprimir->setName('seg_apolice_printer');
        $this->setSortInitial('id','desc');
        
        $this->setExtendedFromJs('Seguradora/View/Grid/Js/ApoliceGrid');
        

    }

    protected function getPageName()
    {
        return 'seg_apolice_list';
    }

}
