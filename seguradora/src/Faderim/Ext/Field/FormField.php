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
            $this->setMaxLength($maxLength);
        }
        $this->setProperty('xtype', $type);
        $this->setProperty('msgTarget', 'qtip');
//        $this->setProperty('beforeLabelTextTpl', Array('<tpl if="allowBlank==false"><span style="color:red"></tpl>'));
//        $this->setProperty('afterLabelTextTpl', Array('<tpl if="allowBlank==false"></span></tpl>'));
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
            $this->setProperty('beforeLabelTextTpl', Array('<tpl><span style="color:red"></tpl>'));
            $this->setProperty('afterLabelTextTpl', Array('<tpl></span></tpl>'));
        } else {
            $this->setProperty('beforeLabelTextTpl', Array(''));
            $this->setProperty('afterLabelTextTpl', Array(''));
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

    public function setMaxLength($maxLength)
    {
        if ($maxLength) {
            $this->setProperty('enforceMaxLength', true);
            $this->setProperty('maxLength', $maxLength);
        } else {
            $this->removeProperty('enforceMaxLength');
            $this->removeProperty('maxLength');
        }
    }

}
