<?php

namespace Faderim\Framework\View\Grid;

use Faderim\Ext\Field\GridField;
use Faderim\Ext\Field\TypeField;

/**
 * Description of System
 *
 * @author Rodrigo Cândido
 */
class RouterGrid extends BaseViewGrid
{

    public function getPageName()
    {
        return 'fd_router_list';
    }

    public function createComponents()
    {
        $this->setTitle('Consulta Router');
        $this->addChild(new GridField(TypeField::TYPE_TEXT, 'name', 'Nome', 0.3, true));
        $this->addChild(new GridField(TypeField::TYPE_TEXT, 'title', 'Título', 0.8, true));
        $this->addChild(new GridField(TypeField::TYPE_TEXT, 'page/name', 'Page', 0.4, true));
        $this->addChild(new GridField(TypeField::TYPE_TEXT, 'controllerName', 'Controller', 0.8, true));
        $this->addChild(new GridField(TypeField::TYPE_TEXT, 'path', 'Path', 0.3, true));

        $this->addAction('Incluir', 'fd_router_add');
        $this->addRowAction('Alterar', 'fd_router_edit');
        $action = $this->addRowAction('Excluir', 'fd_router_delete');
        $action->setType(\Faderim\Ext\Grid\ActionGrid::TYPE_HIDE);
        $action->setMultiple(true);
    }

}
