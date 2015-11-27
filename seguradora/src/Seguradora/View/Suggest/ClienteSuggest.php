<?php

namespace Seguradora\View\Suggest;

use Faderim\Ext\Field\FormField;
use Faderim\Ext\Field\TypeField;

/**
 * Description of ClienteSuggest
 *
 * @author Rodrigo Cândido
 */
class ClienteSuggest extends \Faderim\Ext\Form\AbstractSuggest
{

    public function __construct($name = 'cliente', $label = 'Cliente')
    {
        parent::__construct($name, $label);
    }

    protected function createInstanceController()
    {
        return new \Seguradora\Controller\Grid\ClienteGridController();
    }

    protected function defineFields()
    {
        $this->setSuggest('nome', $this->getName() .'/nome');
        $field = new FormField(TypeField::TYPE_NUMBER, $this->getName() . '/id', $this->getTitle(), false, 10);
        $field->setWidth(60);
        $this->setField($field, 'id');
    }

}
