<?php

namespace Faderim\Ext\Field;

/**
 * Description of TextTypeField
 *
 * @author Rick
 */
class TypeFieldCheckbox extends TypeField
{

    public function getExtType()
    {
        return 'Ext.form.field.Checkbox';
    }

    public function getExtTypeColumn()
    {
        return 'booleancolumn';
    }

    public function parseGetModelValue($value)
    {
        return (boolean) parent::parseGetModelValue($value);
    }

    public function parseSetModelValue($value)
    {
        $value = parent::parseSetModelValue($value);
        $this->setCustomProperty('checked', $value);
        return $value;
    }

}
