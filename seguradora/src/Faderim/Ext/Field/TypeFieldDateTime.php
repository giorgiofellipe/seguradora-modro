<?php

namespace Faderim\Ext\Field;

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TextTypeField
 *
 * @author Rick
 */
class TypeFieldDateTime extends TypeField
{

    public function __construct($name)
    {
        parent::__construct($name);
        $this->setCustomProperty('dateFormat', 'd/m/Y H:i:s');
        $this->setCustomProperty('format', 'd/m/Y H:i:s');
    }

    public function getExtType()
    {
        return 'Ext.form.field.Date';
    }

    public function getExtTypeColumn()
    {
        return 'datecolumn';
    }

    public function parseGetModelValue($value)
    {
        if (empty($value)) {
            return null;
        }
        $dateTime = \DateTime::createFromFormat(\Faderim\Date\DateTime::FORMAT_DATETIME, $value);
        return $dateTime;
    }

    public function parseSetModelValue($value)
    {
        if ($value instanceof \DateTime) {
            $value = $value->format(\DateTime::W3C);
        }
        return $value;
    }

}
