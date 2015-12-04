<?php

namespace Seguradora\Controller\Form;

/**
 * Description of ClienteFormController
 *
 * @author Rodrigo Cândido
 */
class GerencialReportFormController extends \Faderim\Framework\Controller\BaseController
{   
    protected $view = null;
    const RELATORIO_GERENCIAL_HISTORICO_PROPOSTAS = 1;
    const RELATORIO_GERENCIAL_TITULOS_VENCER = 2;

    public function imprimir(){
        if($this->getRequest()->isPost()){
            
        } else{
            return $this->getView();
        }
    }
    
    public function getView(){
        if($this->view == null){
            $this->view  = new \Seguradora\View\Form\GerencialReportForm();
        }
        return $this->view;
    }
    
    public static function getRelatorioGerencialList(){
        return new \Faderim\Util\Enumerator(array(
            self::RELATORIO_GERENCIAL_HISTORICO_PROPOSTAS=>'Histórico de Propostas',
            self::RELATORIO_GERENCIAL_TITULOS_VENCER=>'Títulos a Vencer'
        ));
    }

}
