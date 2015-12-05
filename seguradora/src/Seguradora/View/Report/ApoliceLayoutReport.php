<?php

namespace Seguradora\View\Report;

/**
 * Description of ApoliceLayoutReport
 *
 * @author Rodrigo Candido <rodrigo@magamobi.com.br>
 */
class ApoliceLayoutReport extends BaseLayoutReport {
    
    
    public function render() {
        $this->createInformacaoGeral();
        $this->createQuestionario();
        echo '<hr />';
    }
    
    public function createInformacaoGeral(){
        echo '<table align="center" class="table">';
        echo '<tr class="titulo fundo_titulo">';
        echo '<td>Proposta:</td>';
        echo '<td>'.$this->getModel()->getId().'</td>';
        echo '<td>Status: </td>';
        echo '<td>'.  \Seguradora\Model\Apolice::getSituacaoList()->getDescription($this->getModel()->getSituacao()).'</td>';
        echo '<td>Data Vigência: </td>';
        echo '<td>';
        echo $this->getModel()->getDataInicio()->format(\Faderim\Date\DateTime::FORMAT_DATE);
        echo ' - '.$this->getModel()->getDataInicio()->format(\Faderim\Date\DateTime::FORMAT_DATE);
        echo '</td>';
        echo '</tr>';
        
        echo '<tr>';
        echo '<td>Cliente: </td>';
        echo '<td>'.$this->getModel()->getCliente()->getNome().'</td>';
        echo '<td>CPF: </td>';
        echo '<td>'.$this->getModel()->getCliente()->getCpf().'</td>';
        echo '<td>Telefone: </td>';
        echo '<td>'.$this->getModel()->getCliente()->getTelefone().'</td>';        
        echo '</tr>';
        
        echo '<tr>';
        echo '<td>Descrição do Bem: </td>';
        echo '<td colspan="5">'.$this->getModel()->getDescricaoBem().'</td>';
        echo '</tr>';
        
        echo '<tr>';
        echo '<td>Valor do Bem: </td>';
        echo '<td>'.   $this->getModel()->getValorBem().'</td>';
        echo '<td>Valor do Prêmio: </td>';
        echo '<td>'.$this->getModel()->getValorPremio().'</td>';
        echo '<td>Valor Franquia: </td>';
        echo '<td>??</td>';        
        echo '</tr>';
        echo '</table>';
    }
    
    public function createQuestionario(){        
        echo '<div style="width:88%;text-align:left;border-left:1px solid black;border-right:1px solid black;margin: 0 auto;padding:5px;">';
        foreach($this->getModel()->getApolicePerguntaAgrupadoReport() as $grupos){
            foreach($grupos as $index => $apolicePergunta){
                if($index == 0){
                    echo '<strong>'.$apolicePergunta->getTipoPergunta()->getDescricao() .'</strong>';
                    echo '<ul>';
                }            
                echo '<li>'.$apolicePergunta->getDescricao().'</li>';                
            }
            echo '</ul>';
        }
        echo '</div>';
    }


    /**
     * 
     * @return \Seguradora\Model\Apolice
     */
    public function getModel() {
        return parent::getModel();
    }

    
}
