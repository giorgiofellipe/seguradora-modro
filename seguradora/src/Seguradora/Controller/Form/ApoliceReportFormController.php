<?php

namespace Seguradora\Controller\Form;

/**
 * Description of ApoliceFormController
 *
 * @author Rodrigo Cândido
 */
class ApoliceReportFormController extends \Faderim\Framework\Controller\BaseFormController
{

    public function imprimir(){        
        $rows = $this->getRows();
        $this->loadModelByKeys($rows[0]);
        $view = new \Seguradora\View\Report\ApoliceLayoutReport(Array($this->getModel()));            
        $view->setTitulo('Apólice de Seguro');
        echo $view->imprimir();
        die;
    }
    
    
    protected function createInstanceModel()
    {
        return new \Seguradora\Model\Apolice();
    }

    protected function createInstanceView()
    {
        return null;
    }
}
