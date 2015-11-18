<?php

namespace Faderim\Ext\Store;

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of BaseStore
 *
 * @author Ricardo
 */
abstract class BaseStore extends \Faderim\Ext\Component
{

    /**
     *
     * @var \Faderim\Ext\Field\TypeField
     */
    protected $fields = Array();

    public function __construct()
    {

    }

    public function addField(\Faderim\Ext\Field\TypeField $Field)
    {
        $this->fields[] = $Field;
    }

    /**
     *
     * @param type $name
     * @return \Faderim\Ext\Field\TypeField
     */
    public function getField($name)
    {
        foreach ($this->fields as $field) {
            if ($field->getName() == $name) {
                return $field;
            }
        }
        return null;
    }

    //getExtClassName
    protected function getExtClassName()
    {
        return 'Ext.data.' . $this->getTypeStore() . 'Store';
    }

    abstract public function getTypeStore();

    protected function getExtProperties()
    {
        $aProps = parent::getExtProperties();
        if ($this->getArrayFields()) {
            $aProps['fields'] = $this->getArrayFields();
        }
        return $aProps;
    }

    public function getFields()
    {
        return $this->fields;
    }

    public function setGroup($groupName)
    {
        $this->setProperty('groupField', $groupName);
    }

    public function setSort($column, $type = 'ASC')
    {
        $this->setProperty('sorters', Array('property' => $column, 'direction' => $type));
    }

    protected function getArrayFields()
    {
        return $this->fields;
    }

}
