<?php

namespace Faderim\Framework\View\Form;

use Faderim\Ext\Field as Field;
use Faderim\Ext\Field\TypeField;

/**
 * Description of PageForm
 *
 * @author Rodrigo Cândido
 */
class PageForm extends \Faderim\Ext\AbstractForm
{

    protected function createChilds()
    {
        $nome = new Field\FormField(TypeField::TYPE_TEXT, 'name', 'Nome', true, 50);
        $system = new Field\FormField(TypeField::TYPE_LIST, 'system', 'Sistema', true, 25);
        $storeSystem = $system->getTypeField()->getModelStore();
        $storeSystem->setModelFromRepository('Faderim\Framework\Model\System', Array('name'));
        $title = new Field\FormField(TypeField::TYPE_TEXT, 'title', 'Título', true, 255);
        $this->addChilds($system, $nome, $title);
    }

    protected function getFormName()
    {
        return 'form_page';
    }

}
