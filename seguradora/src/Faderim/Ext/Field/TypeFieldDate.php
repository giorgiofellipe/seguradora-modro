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
class TypeFieldDate extends TypeField {

    public function __construct($name) {
        parent::__construct($name);
        $this->setCustomProperty('dateFormat', 'd/m/Y');
        $this->setCustomProperty('format', 'd/m/Y');
        $this->setCustomProperty('altFormats', \DateTime::W3C);
    }

    public function getExtType() {
        return 'Ext.form.field.Date';
    }

    public function getExtTypeColumn() {
        return 'datecolumn';
    }

    public function parseGetModelValue($value) {
        if (empty($value)) {
            return null;
        }
        $dateTime = new \Faderim\Date\DateTime($value);
        return $dateTime->getObject();
    }

    public function parseSetModelValue($value) {
        if ($value instanceof \DateTime) {
            $value = $value->format(\DateTime::W3C);
        }
        return $value;
    }

}
