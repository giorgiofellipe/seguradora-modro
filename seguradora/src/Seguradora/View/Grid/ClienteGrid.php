<?php

namespace Seguradora\View\Grid;

use Faderim\Ext\Field\GridField;
use Faderim\Ext\Field\TypeField;

/**
 * Description of PerguntaGrid
 *
 * @author Rodrigo Cândido
 */
class ClienteGrid extends \Faderim\Framework\View\Grid\BaseViewGrid
{

    protected function createComponents()
    {
        $this->addChild(new GridField(TypeField::TYPE_NUMBER, 'id', 'Código', 0.1, true));

        $this->addChild(new GridField(TypeField::TYPE_TEXT, 'nome', 'Nome', 0.4, true));

        $this->addChild(new GridField(TypeField::TYPE_NUMBER, 'cpf', 'CPF', 0.1, true));

        
        $this->addActionAdd('seg_cliente');
        $this->addActionEdit('seg_cliente');
        $this->addActionDelete('seg_cliente');
    }

    protected function getPageName()
    {
        return 'seg_cliente_list';
    }

}
