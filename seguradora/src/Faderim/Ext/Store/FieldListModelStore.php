<?php

namespace Faderim\Ext\Store;

/**
 * Description of FieldListDefaultStore
 *
 * @author Rick
 */
class FieldListModelStore extends DataStore
{

    /**
     *
     * @var \Faderim\Ext\Field\TypeFieldList
     */
    private $typeField;
    private $keys = Array();
    private $repositoryName;

    public function __construct(\Faderim\Ext\Field\TypeFieldList $fieldList)
    {
        parent::__construct();
        $this->typeField = $fieldList;
        parent::addField(new \Faderim\Ext\Field\TypeFieldText('__key'));
    }

    protected function onCreate()
    {
        parent::onCreate();
        $em = \Faderim\Core\FaderimEngine::getInstance()->getEntityManager();
        $enumSystem = $em->getRepository($this->repositoryName)->findAll();
        foreach ($enumSystem as $modelSystem) {
            $this->addModel($modelSystem);
        }
    }

    public function setModelFromRepository($repository, Array $descriptor)
    {
        $template = Array();
        foreach ($descriptor as $name) {
            $template[] = '{' . $name . '}';
        }
        $this->typeField->setTemplate(implode(' - ', $template));
        $this->repositoryName = $repository;
        $em = \Faderim\Core\FaderimEngine::getInstance()->getEntityManager();
        $metaData = $em->getClassMetadata($this->repositoryName);
        $this->keys = $metaData->getIdentifierFieldNames();
        foreach ($this->keys as $name) {
            $this->addField(new \Faderim\Ext\Field\TypeFieldText($name));
        }
        foreach ($descriptor as $name) {
            $this->addField(new \Faderim\Ext\Field\TypeFieldText($name));
        }
    }

    public function createModelFromValue($value)
    {
        if (!is_object($value)) {
            $map = json_decode($value, true);
        }
        $em = \Faderim\Core\FaderimEngine::getInstance()->getEntityManager();
        $value = $em->find($this->repositoryName, $map);
        return $value;
    }

    public function createModelsFromValueMultiple($values)
    {
        $values = json_decode($values);
        $models = new \Doctrine\Common\Collections\ArrayCollection();
        foreach ($values as $value) {

            $model = $this->createModelFromValue($value);
            if ($model !== null) {
                $models->add($model);
            }
        }
        return $models;
    }

    public function getKeyValueFromModel($model)
    {
        if ($model === null) {
            return null;
        }
        $key = Array();
        foreach ($this->keys as $name) {
            $value = \Faderim\Bean\ModelBean::getModelProperty($model, $name);
            $key[$name] = $value;
        }
        return json_encode($key);
    }

    public function getKeyValuesFromTargetEntity($models)
    {
        $values = Array();
        if ($models !== null) {
            foreach ($models as $model) {
                $values[] = $this->getKeyValueFromModel($model);
            }
        }
        return $values;
    }

    public function addModel($model)
    {
        $values = Array();
        foreach ($this->fields as $field) {
            $name = $field->getName();
            if ($name == '__key') {
                continue;
            }
            $value = \Faderim\Bean\ModelBean::getModelProperty($model, $name);
            $values[$name] = $value;
        }
        $values['__key'] = $this->getKeyValueFromModel($model);
        $this->addRow($values);
    }

}
