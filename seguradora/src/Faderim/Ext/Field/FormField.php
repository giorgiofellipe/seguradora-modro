<?php

namespace Faderim\Ext\Field;

/**
 * Description of FormField
 *
 * @author Ricardo
 */
class FormField extends BaseField
{

    //put your code here
    public function __construct($type, $name, $title = 'Field', $required = true, $maxLength = 0)
    {
        parent::__construct($type, $name, $title);
        $this->setRequired($required);
        if ($maxLength) {
            $this->setProperty('enforceMaxLength', true);
            $this->setProperty('maxLength', $maxLength);
            $this->setProperty('xtype', $type);
        }
    }

    public function setModelValue($value)
    {
        $value = $this->getTypeField()->parseSetModelValue($value);
        $this->setValue($value);
    }

    public function setValue($value)
    {
        $this->setProperty('value', $value);
    }

    public function getModelValue()
    {
        $value = $this->getProperty('value');
        return $this->getTypeField()->parseGetModelValue($value);
    }

    public function setDisabled($disabled)
    {
        $this->setProperty('disabled', (boolean) $disabled);
    }

    public function setRequired($required)
    {
        $this->setProperty('allowBlank', (bool) !$required);
        if ($required) {
            //$this->setProperty('afterLabelTextTpl', '<span style="color:red;font-weight:bold" data-qtip="Obrigatório">*</span>');
        } else {
            unset($this->properties['afterLabelTextTpl']);
        }
    }

    public function getRequired()
    {
        return (bool) (!$this->getProperty('allowBlank'));
    }

    public function setReadOnly($read)
    {
        $this->setProperty('readOnly', (bool) $read);
    }

    protected function getExtClassName()
    {
        return $this->TypeField->getExtType();
        //return 'Ext.form.field.' . $this->getExtClassByType();
    }

    protected function getExtClassByType()
    {
        return $this->TypeField->getExtType();
    }

    protected function getExtProperties()
    {
        $aPropriedades = parent::getExtProperties();
        $aNovasProp = $this->TypeField->getCustomProperties();
        foreach ($aNovasProp as $sCustomKey => $xValue) {
            $aPropriedades[$sCustomKey] = $xValue;
        }
        return $aPropriedades;
    }

}
