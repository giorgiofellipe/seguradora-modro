<?php

namespace Seguradora\View\Suggest;

use Faderim\Ext\Field\FormField;
use Faderim\Ext\Field\TypeField;

/**
 * Description of ClienteSuggest
 *
 * @author Rodrigo Cândido
 */
class TipoSeguroSuggest extends \Faderim\Ext\Form\AbstractSuggest
{

    public function __construct($name = 'tipoSeguro', $label = 'Tipo de Seguro')
    {
        parent::__construct($name, $label);
    }

    protected function createInstanceController()
    {
        return new \Seguradora\Controller\Grid\TipoSeguroGridController();
    }

    protected function defineFields()
    {
        $this->setSuggest('descricao', $this->getName() .'/descricao');
        $field = new FormField(TypeField::TYPE_NUMBER, $this->getName() . '/id', $this->getTitle(), false, 10);
        $field->setWidth(60);
        $this->setField($field, 'id');
    }

}
