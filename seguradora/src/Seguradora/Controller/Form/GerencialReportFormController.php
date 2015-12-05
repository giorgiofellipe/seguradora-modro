<?php

namespace Seguradora\Controller\Form;

/**
 * Description of ClienteFormController
 *
 * @author Rodrigo Cândido
 */
class GerencialReportFormController extends \Faderim\Framework\Controller\BaseFormController
{   
    const RELATORIO_GERENCIAL_HISTORICO_PROPOSTAS = 1;
    const RELATORIO_GERENCIAL_TITULOS_VENCER = 2;

    public function imprimir(){
        if($this->getRequest()->isPost()){
            $this->beanRequest();
            $report = $this->getView()->findChild('report')->getModelValue();
            $dataInicio = $this->getView()->findChild('dataInicio')->getModelValue();
            $dataFim = $this->getView()->findChild('dataFim')->getModelValue();
            $situacao = $this->getView()->findChild('situacao')->getModelValue();
            /* @var $repository \Seguradora\Repository\ApoliceRepository */
            $repository = $this->getEntityManager()->getRepository('Seguradora\Model\Apolice');
            $models = $repository->getQueryReportGerencial($dataInicio, $dataFim, $situacao, $report);
            $view = new \Seguradora\View\Report\GerencialLayoutReport($models);            
            $view->setTitulo(self::getRelatorioGerencialList()->getDescription($report));
            $labelFiltros = Array();
            if($dataInicio){
                $labelFiltros[] = 'Período de Início: ' .$dataInicio->format(\Faderim\Date\DateTime::FORMAT_DATE);
            }
            if($dataFim){
                $labelFiltros[] = 'Período Fim: ' .$dataFim->format(\Faderim\Date\DateTime::FORMAT_DATE);
            }
            if($situacao){
                $labelFiltros[] = 'Situação: ' . \Seguradora\Model\Apolice::getSituacaoList()->getDescription((int)$situacao);
            }
            if(count($labelFiltros) > 0){
                $view->setFiltros(implode(', ',$labelFiltros));
            }
            echo $view->imprimir();
            die;
        } else{
            return $this->getView();
        }
    }
    
    public static function getRelatorioGerencialList(){
        return new \Faderim\Util\Enumerator(array(
            self::RELATORIO_GERENCIAL_HISTORICO_PROPOSTAS=>'Histórico de Propostas',
            self::RELATORIO_GERENCIAL_TITULOS_VENCER=>'Títulos a Vencer'
        ));
    }
    
    protected function createInstanceModel() {
        return new \Seguradora\Model\Apolice();
    }

    protected function createInstanceView() {
        return new \Seguradora\View\Form\GerencialReportForm();
    }


}
