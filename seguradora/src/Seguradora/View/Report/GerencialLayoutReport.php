<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Seguradora\View\Report;

/**
 * Description of GerencialLayoutReport
 *
 * @author Rodrigo Candido
 */
class GerencialLayoutReport extends BaseLayoutReport {
    
    
    public function render() {
        echo '<tr>';
        echo '<td>'.$this->getModel()->getId().'</td>';
        echo '<td>'.$this->getModel()->getDataInicio()->format(\Faderim\Date\DateTime::FORMAT_DATE).'</td>';
        echo '<td>'.$this->getModel()->getDataFim()->format(\Faderim\Date\DateTime::FORMAT_DATE).'</td>';
        echo '<td>'. $this->getModel()->getTipoSeguro()->getDescricao().'</td>';
        echo '<td>'. $this->getModel()->getCliente()->getNome().'</td>';
        echo '<td>'. $this->getModel()->getValorBem().'</td>';
        echo '<td>'. $this->getModel()->getValorPremio().'</td>';
        echo '<td>'.  \Seguradora\Model\Apolice::getSituacaoList()->getDescription($this->getModel()->getSituacao()) .'</td>';
        echo '</tr>';
    }
    
    protected function renderCabecalho() {        
        parent::renderCabecalho();
        ?>
        <table align="center" class="table">
            <tr class="titulo">                
                <td>Número</td>
                <td>Data Início</td>
                <td>Data Fim</td>
                <td>Tipo Seguro</td>
                <td>Cliente</td>
                <td>Valor Bem</td>                
                <td>Valor Prêmio</td>                
                <td>Situação</td>
            </tr>        
        <?php
    }
    
    protected function renderRodape() {
        echo '</table>';
        parent::renderRodape();
    }
    /**
     * 
     * @return \Seguradora\Model\Apolice
     */
    public function getModel() {
        return parent::getModel();
    }

    
}
