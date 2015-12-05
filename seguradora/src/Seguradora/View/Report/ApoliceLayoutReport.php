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
        echo '<hr />';
        $this->createQuestionario();
        echo '<hr />';
        $this->createOpcoesParcelamento();
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
        echo '<td>Tipo do Seguro: </td>';
        echo '<td colspan="2">'.$this->getModel()->getTipoSeguro()->getDescricao().'</td>';
        echo '<td>Seguro Região: </td>';
        echo '<td colspan="2">'.$this->getModel()->getTipoSeguroRegiao()->getRegiao().'</td>';        
        echo '</tr>';
        
        echo '<tr>';
        echo '<td>Descrição do Bem: </td>';
        echo '<td colspan="5">'.$this->getModel()->getDescricaoBem().'</td>';
        echo '</tr>';
        
        echo '<tr>';
        echo '<td>Ano Fabricação/Modelo: </td>';
        echo '<td>'.   $this->getModel()->getAnoFabricacao().'/'.   $this->getModel()->getAnoModelo().'</td>';
        echo '<td>Fabricante: </td>';
        echo '<td>'.   $this->getModel()->getFabricante().'</td>';
        echo '<td>Placa: </td>';
        echo '<td>'.   $this->getModel()->getPlaca().'</td>';        
        echo '</tr>';
        
        echo '<tr>';
        echo '<td>Proprietário: </td>';
        echo '<td colspan="2">'.   $this->getModel()->getProprietario()->getNome().'</td>';
        echo '<td>Condutor: </td>';
        echo '<td colspan="2">'.   $this->getModel()->getCondutor()->getNome().'</td>';        
        echo '</tr>';
        
        echo '<tr>';
        echo '<td>Valor do Bem: </td>';
        echo '<td>R$ '.   \Faderim\Util\FloatUtil::floatToStr($this->getModel()->getValorBem()).'</td>';
        echo '<td>Valor do Prêmio: </td>';
        echo '<td>R$ '. \Faderim\Util\FloatUtil::floatToStr($this->getModel()->getValorPremio()).'</td>';
        echo '<td>Valor Franquia: </td>';
        echo '<td>R$ '.\Faderim\Util\FloatUtil::floatToStr($this->getModel()->getValorFranquia()).'</td>';        
        echo '</tr>';
        echo '</table>';
    }
    
    public function createQuestionario(){        
        echo '<h4>Cláusulas e Questionário</h4>';
        echo '<div style="width:88%;text-align:left;margin: 0 auto;padding:5px;">';
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
    public function createOpcoesParcelamento(){        
        echo '<h4>Opções de Parcelamento</h4>';
        echo '<table align="center" class="table">';
        echo '<tr class="titulo fundo_titulo">';
        echo '<td>Parcelas</td>';
        echo '<td>Valor</td>';
        echo '</tr>';
        for($x = 1; $x <=10;$x++){
            $valorParcela = $this->getModel()->getValorPremio() / $x;
            echo '<tr>';
            echo '<td>'. str_pad($x, 2,'0',STR_PAD_LEFT). 'x</td>';
            echo '<td>R$ '.\Faderim\Util\FloatUtil::floatToStr($valorParcela).'</td>';
            echo '</tr>';
        }
        echo '</table>';
    }


    /**
     * 
     * @return \Seguradora\Model\Apolice
     */
    public function getModel() {
        return parent::getModel();
    }

    
}
