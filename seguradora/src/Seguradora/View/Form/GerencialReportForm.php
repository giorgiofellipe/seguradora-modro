<?php

namespace Seguradora\View\Form;

use Faderim\Ext\Field as Field;
use Faderim\Ext\Field\TypeField;

/**
 * Description of PerguntaForm
 *
 * @author Rodrigo Cândido <rodrigocandido.bsi@gmail.com>
 */
class GerencialReportForm extends \Faderim\Ext\AbstractForm
{

    public function __construct() {
        $this->labelWidth = 100;
        parent::__construct();
    }
    protected function createChilds()
    {
        $reports = new Field\FormField(TypeField::TYPE_LIST, 'report', 'Relatório', true, 250);
        $reports->getTypeField()->getLocalStore()->setEnumerator(\Seguradora\Controller\Form\GerencialReportFormController::getRelatorioGerencialList());
        
        $dataInicio = new Field\FormField(TypeField::TYPE_DATE, 'dataInicio', 'Período Início', false);
        $dataFim = new Field\FormField(TypeField::TYPE_DATE, 'dataFim', 'Período Fim', false);        
        
        $situacao = new Field\FormField(TypeField::TYPE_LIST, 'situacao', 'Situação', false);        
        $situacao->getTypeField()->getLocalStore()->setEnumerator(\Seguradora\Model\Apolice::getSituacaoList());        
        
        $this->addChilds($reports,$dataInicio,$dataFim,$situacao);
        
        $this->setExtendedFromJs('Seguradora/View/Form/Js/GerenciarReportForm');
    }

    protected function getFormName()
    {
        return 'form_gerencial_report';
    }

}
