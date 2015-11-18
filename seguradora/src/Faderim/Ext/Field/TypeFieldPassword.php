<?php

namespace Faderim\Ext\Field;

/**
 * Description of PasswordTypeField
 * @author Rodrigo Cândido
 */
class TypeFieldPassword extends TypeField
{

    public function __construct($name)
    {
        parent::__construct($name);
        $this->setCustomProperty('inputType', self::TYPE_PASSWORD);
    }

}
