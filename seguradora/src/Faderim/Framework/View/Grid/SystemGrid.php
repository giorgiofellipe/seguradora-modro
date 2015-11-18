<?php

namespace Faderim\Framework\View\Grid;

use Faderim\Ext\Field\GridField;
use Faderim\Ext\Field\TypeField;

/**
 * Description of System
 *
 * @author Ricardo Schroeder
 */
class SystemGrid extends BaseViewGrid
{

    public function getPageName()
    {
        return 'fd_system_list';
    }

    public function createComponents()
    {
        $this->setTitle('Consultar Sistemas');
        $this->addChild(new GridField(TypeField::TYPE_TEXT, 'id', 'ID', 0.1, true));
        $this->addChild(new GridField(TypeField::TYPE_TEXT, 'name', 'Nome', 0.2, true));
        $this->addChild(new GridField(TypeField::TYPE_TEXT, 'description', 'Descrição', 0.5, true));
        $this->addChild(new GridField(TypeField::TYPE_TEXT, 'package', 'Pacote', 0.2, true));
        $this->addChild(new GridField(TypeField::TYPE_CHECKBOX, 'enable', 'Ativo', 0.2, true));

        $this->addAction('Incluir', 'fd_system_add');
        $this->addRowAction('Alterar', 'fd_system_edit');
        $action = $this->addRowAction('Excluir', 'fd_system_delete');
        $action->setType(\Faderim\Ext\Grid\ActionGrid::TYPE_HIDE);
        $action->setMultiple(true);
    }

}
