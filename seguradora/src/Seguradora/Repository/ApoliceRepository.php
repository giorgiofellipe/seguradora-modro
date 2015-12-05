<?php

namespace Seguradora\Repository;

use Faderim\Framework\Repository\BaseEntityRepository;
use Seguradora\Controller\Form\GerencialReportFormController;

/**
 * Description of ApoliceRepository
 *
 * @author Rodrigo Cândido
 */
class ApoliceRepository extends BaseEntityRepository
{
    public function getQueryReportGerencial($dataInicio,$dataFim,$situacao,$report){
        $dql = 'select apolice
                  from \Seguradora\Model\Apolice apolice
                 where 1 = 1 ';
        
        $params = Array();
        $colunaData = ($report == GerencialReportFormController::RELATORIO_GERENCIAL_HISTORICO_PROPOSTAS) ? 'dataInicio' : 'dataFim';
        $colunaData = 'apolice.' . $colunaData;
        if($dataFim && $dataFim){            
            $dql .= ' and '. $colunaData . ' between :dataInicio and :dataFim' ;
            $params['dataInicio'] = $dataInicio->format(\Faderim\Date\DateTime::FORMAT_DATE_ISO);
            $params['dataFim'] = $dataFim->format(\Faderim\Date\DateTime::FORMAT_DATE_ISO);
        } else if($dataFim) {            
            $dql .= ' and '. $colunaData . ' <=  :dataFim' ;
            $params['dataFim'] = $dataFim->format(\Faderim\Date\DateTime::FORMAT_DATE_ISO);
        } else if($dataInicio){                        
            $params['dataInicio'] = $dataInicio->format(\Faderim\Date\DateTime::FORMAT_DATE_ISO);
            $dql .= ' and '. $colunaData . ' >=  :dataInicio ';
        }
        if($situacao){
            $params['situacao'] = $situacao;
            $dql .= ' and apolice.situacao in (:situacao) ';
        }
//        echo '<pre>';
//        print_r($params);
        $dql .= ' order by apolice.situacao ';
        $query = $this->getEntityManager()->createQuery($dql);
        $query->setParameters($params);
        $query->execute();
        return $query->getResult();
    }
}
