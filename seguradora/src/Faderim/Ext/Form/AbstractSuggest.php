<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Faderim\Ext\Form;

/**
 * Description of AbstractSuggest
 *
 * @author Ricardo Schroeder <ricardo@magamobi.com.br>
 */
abstract class AbstractSuggest extends \Faderim\Ext\Form\SuggestContainer
{

    public function __construct($name, $label)
    {
        parent::__construct($name);
        $this->setTitle($label);
        $this->extractInfoController();
    }

    protected function extractInfoController()
    {
        $this->defineFields();
        $ctrl = $this->createInstanceController();
        $this->setStore($ctrl->getView()->getStore());
        $className = $ctrl->getRepository()->getClassName();
        $this->mapper->setRepositoryName($className);
        $this->setProperty('router', $ctrl->getView()->getDefaultRouterName());
    }

    abstract protected function createInstanceController();

    abstract protected function defineFields();
}
