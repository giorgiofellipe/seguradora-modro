<?php

namespace Faderim\Framework\View\Form;

use Faderim\Ext\Field as Field;
use Faderim\Ext\Field\TypeField;

/**
 * Description of System
 *
 * @author Rodrigo Cândido
 */
class RouterForm extends \Faderim\Ext\AbstractForm
{

    public function getFormName()
    {
        return 'form_router';
    }

    public function createChilds()
    {

        $this->setTitle('Manutenção');

        $page = new Field\FormField(TypeField::TYPE_LIST, 'page', 'Page', true, 50);
        $storePage = $page->getTypeField()->getModelStore();
        $storePage->setModelFromRepository('Faderim\Framework\Model\Page', Array('name'));
        $this->addChild($page);

        $o = new Field\FormField(TypeField::TYPE_TEXT, 'name', 'Nome', true, 255);
        $this->addChild($o);

        $o = new Field\FormField(TypeField::TYPE_TEXT, 'title', 'Título', true, 255);
        $this->addChild($o);

        $o = new Field\FormField(TypeField::TYPE_TEXT, 'controllerName', 'Controller', true, 255);
        $this->addChild($o);

        $o = new Field\FormField(TypeField::TYPE_TEXT, 'path', 'Path', false, 255);
        $this->addChild($o);
    }

}
