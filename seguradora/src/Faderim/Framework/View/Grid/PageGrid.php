<?php

namespace Faderim\Framework\View\Grid;

use Faderim\Ext\Field\GridField;
use Faderim\Ext\Field\TypeField;

/**
 * Description of System
 *
 * @author Ricardo Schroeder
 */
class PageGrid extends BaseViewGrid
{

    public function getPageName()
    {
        return 'fd_page_list';
    }

    public function createComponents()
    {
        $this->setTitle('Consulta Page');
        $this->addChild(new GridField(TypeField::TYPE_TEXT, 'name', 'Nome', 0.3, true));
        $this->addChild(new GridField(TypeField::TYPE_TEXT, 'system/name', 'Sistema', 0.3, true));
        $this->addChild(new GridField(TypeField::TYPE_TEXT, 'title', 'Título', 0.8, true));

        $this->addAction('Incluir', 'fd_page_add');
        $this->addRowAction('Alterar', 'fd_page_edit');
        $action = $this->addRowAction('Excluir', 'fd_page_delete');
        $action->setType(\Faderim\Ext\Grid\ActionGrid::TYPE_HIDE);
        $action->setMultiple(true);
    }

}
