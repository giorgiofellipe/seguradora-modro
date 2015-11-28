<?php

namespace Seguradora\View\Grid;

use Faderim\Ext\Field\GridField;
use Faderim\Ext\Field\TypeField;

/**
 * Description of TipoSeguroGrid
 *
 * @author Giorgio Fellipe
 */
class TipoSeguroGrid extends \Faderim\Framework\View\Grid\BaseViewGrid
{

    protected function createComponents()
    {
        $this->addChild(new GridField(TypeField::TYPE_NUMBER, 'id', 'Código', 0.1, true));
        $this->addChild(new GridField(TypeField::TYPE_TEXT, 'descricao', 'Descrição', 0.6, true));
        $this->addChild(new GridField(TypeField::TYPE_NUMBER, 'porcentagemFranquia', 'Porcentagem da Franquia', 0.1, true));
        $this->addActionAdd('seg_tipo_seguro');
        $this->addActionEdit('seg_tipo_seguro');
        $this->addActionDelete('seg_tipo_seguro');
    }

    protected function getPageName()
    {
        return 'seg_tipo_seguro_list';
    }

}
