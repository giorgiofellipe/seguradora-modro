<?php

namespace Faderim\Ext\Field;

/**
 * Description of TextTypeField
 *
 * @author Rodrigo Cândido
 */
class TypeFieldCnpj extends TypeField
{

    public function __construct($name)
    {
        parent::__construct($name);
        $this->setCustomProperty('vtype', 'Cnpj');
        $this->setPlaceHolder('00.000.000/0000-00');
    }

}
