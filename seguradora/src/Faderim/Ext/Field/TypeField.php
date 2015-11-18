<?php

namespace Faderim\Ext\Field;

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TypeField
 *
 * @author Rick
 */
abstract class TypeField implements \Faderim\Json\JsonSerializable
{

    const TYPE_NUMBER = 'number';
    const TYPE_TEXT = 'text';
    const TYPE_TIME = 'time';
    const TYPE_DATE = 'date';
    const TYPE_DATE_TIME = 'dateTime';
    const TYPE_PHONE = 'phone';
    const TYPE_LIST = 'list';
    const TYPE_LIST_TREE = 'listTree';
    const TYPE_EMAIL = 'email';
    const TYPE_CHECKBOX = 'checkbox';
    const TYPE_TEXT_AREA = 'textArea';
    const TYPE_CPF = 'cpf';
    const TYPE_CNPJ = 'cnpj';
    const TYPE_CEP = 'cep';
    const TYPE_FILE = 'file';
    const TYPE_PASSWORD = 'password';
    const TYPE_COLOR = 'color';
    const TYPE_EDITOR = 'editor';

    protected $customProperties = Array();
    protected $name;

    function __construct($name)
    {
        $this->name = $name;
        $this->setCustomProperty('name', $name);
    }

    public function getName()
    {
        return $this->customProperties['name'];
    }

    public function getExtType()
    {
        return 'Ext.form.field.Text';
    }

    public function getExtTypeColumn()
    {
        return null;
    }

    protected function setCustomProperty($name, $value)
    {
        $this->customProperties[$name] = $value;
    }

    public function getJsonFormat()
    {
        return $this->customProperties;
    }

    final public function getCustomProperties()
    {
        return $this->customProperties;
    }

    final public function setPlaceHolder($placeHolder)
    {
        $this->setCustomProperty('emptyText', $placeHolder);
    }

    public function parseGetModelValue($value)
    {
        $val = trim($value);
        if (empty($val)) {
            return null;
        }
        return $value;
    }

    public function parseSetModelValue($value)
    {
        return $value;
    }

}
