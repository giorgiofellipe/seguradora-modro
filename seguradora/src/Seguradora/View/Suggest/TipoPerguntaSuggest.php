<?php

namespace Seguradora\View\Suggest;

use Faderim\Ext\Field\FormField;
use Faderim\Ext\Field\TypeField;

/**
 * Description of TipoPerguntaSuggest
 *
 * @author Giorgio Fellipe
 */
class TipoPerguntaSuggest extends \Faderim\Ext\Form\AbstractSuggest
{

    public function __construct($name = 'tipoPergunta', $label = 'Tipo da Pergunta')
    {
        parent::__construct($name, $label);
    }

    protected function createInstanceController()
    {
        return new \Seguradora\Controller\Grid\TipoPerguntaGridController();
    }

    protected function defineFields()
    {
        $this->setSuggest('descricao', 'tipoPergunta/descricao');
        $field = new FormField(TypeField::TYPE_NUMBER, $this->getName() . '/id', $this->getTitle(), false, 10);
        $field->setWidth(60);
        $this->setField($field, 'id');
    }

}
