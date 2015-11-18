<?php

namespace Seguradora\View\Grid;

use Faderim\Ext\Field\GridField;
use Faderim\Ext\Field\TypeField;

/**
 * Grid de Consulta de Usuários
 *
 * @author Rodrigo Cândido
 */
class UsuarioGrid extends \Faderim\Framework\View\Grid\BaseViewGrid {

    protected function createComponents() {
        $this->addChild(new GridField(TypeField::TYPE_NUMBER, 'id', 'Código', 0.1, true));
        $this->addChild(new GridField(TypeField::TYPE_TEXT, 'nome', 'Nome', 0.6, true));
        $this->addChild(new GridField(TypeField::TYPE_TEXT, 'login', 'E-mail', 0.3, true));
        $this->addActionAdd('seg_usuario');
        $this->addActionEdit('seg_usuario');
        $this->addActionDelete('seg_usuario');
    }

    protected function getPageName() {
        return 'seg_usuario_list';
    }

}
