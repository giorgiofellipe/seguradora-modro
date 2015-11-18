<?php

namespace Faderim\Ext;

/**
 * Description of FormPanel
 *
 * @author Ricardo
 */
abstract class AbstractForm extends FormPanel
{

    /**
     * @todo Criar método dentro do modelo Router que retorna a url no formato exato
     */
    public function __construct()
    {
        parent::__construct($this->getFormName());
        $name = \Faderim\Core\FaderimEngine::getInstance()->getRouter()->getName();
        $this->setProperty('url', '?router=' . $name);
        $this->createChilds();
    }

    public function setDefaultValues(Array $values)
    {
        $this->setProperty('values', $values);
    }

    abstract protected function getFormName();

    abstract protected function createChilds();
}
