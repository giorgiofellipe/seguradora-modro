<?php

namespace Faderim\Ext\Form;

/**
 * Description of SuggestContainer
 *
 * @author Ricardo Schroeder <ricardo@magamobi.com.br>
 */
class SuggestContainer extends FieldContainer
{

    private $fieldSuggest = Array();
    protected $mapper;
    private $value;
    private $parametros = Array();

    /**
     *
     * @var \Faderim\Ext\Store\JsonStore
     */
    private $store;

    public function __construct($name)
    {
        parent::__construct($name);
        $this->mapper = new \Faderim\Json\ModelToJson();
    }

    public function setTitle($title)
    {
        $this->setProperty('fieldLabel', $title);
    }

    public function getTitle()
    {
        return $this->getProperty('fieldLabel');
    }

    public function setStore(\Faderim\Ext\Store\JsonStore $store)
    {
        $store->setAutoLoad(false);
        $this->store = $store;
        $this->setProperty('store', $store);
    }

    public function setSuggest($name, $suggestFieldName)
    {
        $this->addFieldSuggest($name, $suggestFieldName, false, true, true);
        $this->setProperty('suggestFieldName', $suggestFieldName);
    }

    public function addFieldSuggest($name, $bind = false, $find = false, $display = true, $suggest = false)
    {
        $this->fieldSuggest[] = Array('name' => $name, 'bind' => $bind, 'find' => $find, 'display' => $display, 'suggest' => $suggest);
    }

    protected function onCreate()
    {
        parent::onCreate();
        if ($this->value) {
            $this->setProperty('value', $this->getObjectToJson());
        }
        $this->setProperty('fields', $this->fieldSuggest);
        $this->setProperty('parametros', json_encode($this->parametros));
    }

    public function getObjectToJson()
    {
        return $this->mapper->objectToJson($this->value, $this->store->getFields());
    }

    protected function getExtClassName()
    {
        return 'Faderim.form.ContainerExterno';
    }

    public function setField(\Faderim\Ext\Field\FormField $field, $name)
    {
        $this->setTitle($field->getTitle());
        $this->addFieldSuggest($name, $field->getName(), true, true);
        //$suggestPessoa->addFieldSuggest('id', 'pessoa/id', true, true);
        $this->addChild($field);
    }

    /**
     * Alias from getField
     * @param type $name
     * @return type
     */
    public function getField($name)
    {
        return $this->findChild($name);
    }

    public function setRequestValue($value)
    {
        if ($value) {
            $val = $this->mapper->createModelFromString($value);
            $this->value = $val;
        }
    }

    public function beanModel($model)
    {
        $value = $this->value;
        \Faderim\Core\FaderimReflectionClass::callSetter($model, $this->getName(), Array($value));
    }

    public function setModelValue($model)
    {
        $this->value = $model;
    }

    public function getValue()
    {
        return $this->value;
    }

    public function setRequired($required)
    {
        foreach ($this->getChilds() as $child) {
            $child->setRequired($required);
        }
    }

    public function setReadOnly($readOnly = true)
    {
        foreach ($this->getChilds() as $child) {
            $child->setReadOnly($readOnly);
        }
    }

    public function addParametro($nome, $value)
    {
        $this->parametros[$nome] = $value;
    }

}
