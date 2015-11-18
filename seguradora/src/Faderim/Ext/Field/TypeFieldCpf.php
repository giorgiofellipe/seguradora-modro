<?php

namespace Faderim\Ext\Field;

/**
 * Description of TextTypeField
 *
 * @author Rodrigo Cândido
 */
class TypeFieldCpf extends TypeField
{

    public function __construct($name)
    {
        parent::__construct($name);
        $this->setCustomProperty('vtype', 'Cpf');
        $this->setPlaceHolder('000.000.000-00');
    }

}
