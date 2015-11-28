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
        $this->addChild(new GridField(TypeField::TYPE_DATE, 'dataInicio', 'Data Início', 0.2, true));
        $this->addChild(new GridField(TypeField::TYPE_DATE, 'dataFim', 'Data Fim', 0.2, true));
        $this->addChild(new GridField(TypeField::TYPE_TEXT, 'cliente/nome', 'Cliente', 0.4, true));
        
        $this->addActionAdd('seg_apolice');
        $this->addActionEdit('seg_apolice');
        $this->addActionDelete('seg_apolice');
    }

    protected function getPageName()
    {
        return 'seg_apolice_list';
    }

}
