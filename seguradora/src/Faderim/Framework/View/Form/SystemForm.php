<?php

namespace Faderim\Framework\View\Form;

use Faderim\Ext\Field as Field;
use Faderim\Ext\Field\TypeField;

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of System
 *
 * @author Ricardo
 */
class SystemForm extends \Faderim\Ext\AbstractForm
{

    public function getFormName()
    {
        return 'form_system';
    }

    public function createChilds()
    {

        $this->setTitle('Manutenção');
        $o = new Field\FormField(TypeField::TYPE_TEXT, 'id', 'ID', true, 25);
        $this->addChild($o);

        $o = new Field\FormField(TypeField::TYPE_TEXT, 'name', 'Nome', true, 255);
        $this->addChild($o);

        $o = new Field\FormField(TypeField::TYPE_TEXT, 'package', 'Pacote', true, 255);
        $this->addChild($o);

        $o = new Field\FormField(TypeField::TYPE_TEXT_AREA, 'description', 'Descrição', true);
        $this->addChild($o);

        $o = new Field\FormField(TypeField::TYPE_CHECKBOX, 'enable', 'Ativo', false);
        $o->setValue(true);
        $this->addChild($o);
    }

}
