<?php

namespace Faderim\Ext\Grid;

class ActionGrid extends \Faderim\Ext\Button
{

    private $router;
    private $type = 2;
    private $multiple = false;
    private $confirm = false;
    private $parametros;

    const TYPE_HIDE = 1;
    const TYPE_COMPONENT = 2;
    const TYPE_WINDOW = 3;

    function __construct($title, $routerName, $type = self::TYPE_WINDOW)
    {
        parent::__construct(null, $title);
        $this->router = $routerName;
        $this->setType($type);
        //$this->setProperty('text', $title);
    }

    protected function getExtProperties()
    {
        $this->setProperty('faderim_router', $this->router);
        $this->setProperty('faderim_type', $this->type);
        $this->setProperty('faderim_multiple', $this->multiple);
        $this->setProperty('faderim_confirm', $this->confirm);
        $this->setProperty('faderim_params_defaults', $this->getParametros());
        return parent::getExtProperties();
    }

    protected function getExtClassName()
    {
        return 'Faderim.view.ActionGrid';
    }

    public function getType()
    {
        return $this->type;
    }

    public function setType($type)
    {
        $this->type = $type;
        if (self::TYPE_HIDE == $type) {
            $this->setConfirm(true);
        }
    }

    public function getMultiple()
    {
        return $this->multiple;
    }

    public function setMultiple($multiple)
    {
        $this->multiple = $multiple;
    }

    public function getConfirm()
    {
        return $this->confirm;
    }

    public function setConfirm($confirm)
    {
        $this->confirm = $confirm;
    }

    public function getParametros()
    {
        return $this->parametros;
    }

    public function setParametros($parametros)
    {
        $this->parametros = $parametros;
    }

    public function addParametro($nome, $valor)
    {

        if (!isset($this->parametros)) {
            $this->parametros = Array();
        }
        $this->parametros[$nome] = $valor;
    }

    public function getParametro($nome)
    {
        if (isset($this->parametros[$nome])) {
            return $this->parametros[$nome];
        }
        return null;
    }

}
