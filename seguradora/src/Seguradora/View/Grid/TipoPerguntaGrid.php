<?php

namespace Seguradora\View\Grid;

use Faderim\Ext\Field\GridField;
use Faderim\Ext\Field\TypeField;

/**
 * Description of TipoPerguntaGrid
 *
 * @author Giorgio Fellipe
 */
class TipoPerguntaGrid extends \Faderim\Framework\View\Grid\BaseViewGrid
{

    protected function createComponents()
    {
        $this->addChild(new GridField(TypeField::TYPE_NUMBER, 'id', 'Código', 0.1, true));
        $this->addChild(new GridField(TypeField::TYPE_TEXT, 'descricao', 'Descrição', 0.6, true));
        $this->addActionAdd('seg_tipo_pergunta');
        $this->addActionEdit('seg_tipo_pergunta');
        $this->addActionDelete('seg_tipo_pergunta');
    }

    protected function getPageName()
    {
        return 'seg_tipo_pergunta_list';
    }

}
