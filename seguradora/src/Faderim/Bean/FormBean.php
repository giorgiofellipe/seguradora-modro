<?php

namespace Faderim\Bean;

class FormBean
{

    private $mappingProperty = Array();

    public function addMappingProperty($propertyName, $valueMapping)
    {
        $this->mappingProperty[$propertyName] = $valueMapping;
    }

    public function getMappingProperty($name, $parentName = null)
    {
        $nameFind = ($parentName !== null) ? $parentName . '.' . $name : $name;
        if (array_key_exists($nameFind, $this->mappingProperty)) {
            return $this->mappingProperty[$nameFind];
        }
        return $name;
    }

    public function beanRequest(\Faderim\Core\IRequest $request, \Faderim\Ext\Container $form)
    {
        foreach ($form->getChilds() as $campo) {
            $nome = $campo->getName();
            if ($campo instanceof \Faderim\Ext\GridForm) {
                $campo->setFormBean($this);
                $campo->beanRequest($request);
            } else if ($campo instanceof \Faderim\Ext\Form\SuggestContainer) {
                $campo->setRequestValue($request->getParameter($nome));
            } else if ($campo instanceof \Faderim\Ext\TreePanel) {
                $campo->setValue($request->getParameter($nome));
            } else if ($campo instanceof \Faderim\Ext\Container) {
                $this->beanRequest($request, $campo);
            } else if ($request->hasParameter($nome)) {
                $campo->setValue($request->getParameter($nome));
            }
        }
    }

    public function beanModel($model, \Faderim\Ext\Container $form)
    {
        foreach ($form->getChilds() as $campo) {
            $nome = $this->getMappingProperty($campo->getName());
            if ($nome === null) {
                continue;
            }
            if ($campo instanceof \Faderim\Ext\GridForm) {
                $campo->setFormBean($this);
                $campo->beanModel($model);
            } else if ($campo instanceof \Faderim\Ext\Form\SuggestContainer) {
                $campo->beanModel($model);
            } else if ($campo instanceof \Faderim\Ext\Container) {
                $this->beanModel($model, $campo);
            } else {
                $value = $campo->getModelValue();
                \Faderim\Core\FaderimReflectionClass::callSetter($model, $nome, Array($value));
            }
        }
    }

    public function beanForm($model, \Faderim\Ext\Container $form)
    {
        foreach ($form->getChilds() as $campo) {
            $nome = $this->getMappingProperty($campo->getName());
            if ($nome === null) {
                continue;
            }
            if ($campo instanceof \Faderim\Ext\GridForm) {
                $campo->setFormBean($this);
                $campo->beanForm($model);
            } else if ($campo instanceof \Faderim\Ext\Form\SuggestContainer) {
                $value = ModelBean::getModelProperty($model, $nome);
                $campo->setModelValue($value);
            } else if ($campo instanceof \Faderim\Ext\Container) {
                $this->beanForm($model, $campo);
            } else {
                $value = ModelBean::getModelProperty($model, $nome);
                $campo->setModelValue($value);
            }
        }
    }

}
