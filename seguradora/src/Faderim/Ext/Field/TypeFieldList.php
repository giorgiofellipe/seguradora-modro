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
class TypeFieldList extends TypeField
{

    private $Store = null;

    function __construct($name)
    {
        parent::__construct($name);

        $this->setCustomProperty('emptyText', 'Selecione');
        $this->setCustomProperty('allowEmpty', true);
    }

    /**
     *
     * @return \Faderim\Ext\Store\FieldListDefaultStore
     */
    public function getLocalStore()
    {
        if (null == $this->Store) {
            $this->setCustomProperty('queryMode', 'local');
            $this->setCustomProperty('valueField', 'val');
            $this->setCustomProperty('displayField', 'name');
            $this->Store = new \Faderim\Ext\Store\FieldListDefaultStore();
            $this->setCustomProperty('store', $this->Store);
        }
        return $this->Store;
    }

    public function parseGetModelValue($value)
    {
        $value = parent::parseGetModelValue($value);
        if ($value === null) {
            return $value;
        }
        if ($this->Store instanceof \Faderim\Ext\Store\FieldListModelStore) {
            if ($this->isMultipleSelect()) {
                $value = $this->Store->createModelsFromValueMultiple($value);
            } else {
                $value = $this->Store->createModelFromValue($value);
            }
        }
        return $value;
    }

    public function parseSetModelValue($value)
    {
        if ($this->Store instanceof \Faderim\Ext\Store\FieldListModelStore) {
            if ($this->isMultipleSelect()) {
                $value = $this->Store->getKeyValuesFromTargetEntity($value);
            } else {
                $value = $this->Store->getKeyValueFromModel($value);
            }
        }
        return $value;
    }

    /**
     *
     * @return \Faderim\Ext\Store\DataStore
     */
    public function getModelStore()
    {
        if (null == $this->Store) {
            $this->setCustomProperty('queryMode', 'local');
            $this->Store = new \Faderim\Ext\Store\FieldListModelStore($this);
            $this->setCustomProperty('valueField', '__key');
            $this->setCustomProperty('store', $this->Store);
        }
        return $this->Store;
    }

    public function setTemplate($template)
    {
        $this->setCustomProperty('tpl', new \Faderim\Ext\XTemplate('<tpl for="."><div class="x-boundlist-item">' . $template . '</div></tpl>'));
        $this->setCustomProperty('displayTpl', new \Faderim\Ext\XTemplate('<tpl for="." between=", ">' . $template . '</tpl>'));
    }

    public function getExtType()
    {
        return 'Ext.form.field.ComboBox';
    }

    public function getExtTypeColumn()
    {
        return 'listcolumn';
    }

    public function setMultipleSelect($multiple = true)
    {
        $this->setCustomProperty('multiSelect', $multiple);
        $this->setCustomProperty('editable', (!$multiple));
    }

    public function isMultipleSelect()
    {
        return (isset($this->customProperties['multiSelect']) && $this->customProperties['multiSelect'] == true);
    }

}
