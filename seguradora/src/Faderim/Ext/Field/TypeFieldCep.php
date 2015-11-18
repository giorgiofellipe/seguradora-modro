<?php

namespace Faderim\Ext\Field;

/**
 * Description of TextTypeField
 *
 * @author Rodrigo Cândido
 */
class TypeFieldCep extends TypeField
{

    public function __construct($name)
    {
        parent::__construct($name);
        $this->setCustomProperty('vtype', 'Cep');
        $this->setPlaceHolder('00000-000');
    }

}
