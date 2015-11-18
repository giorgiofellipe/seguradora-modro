<?php

namespace Faderim\Json;

/**
 * Description of ModelToJson
 *
 * @author Ricardo Schroeder <ricardo@magamobi.com.br>
 */
class ModelToJson
{

    private $repositoryName;

    public function getRepositoryName()
    {
        return $this->repositoryName;
    }

    public function setRepositoryName($repositoryName)
    {
        $this->repositoryName = $repositoryName;
    }

    protected function getClassMetadata()
    {
        $em = \Faderim\Core\FaderimEngine::getInstance()->getEntityManager();
        $metaData = $em->getClassMetadata($this->repositoryName);
        return $metaData;
    }

    protected function getClassKeys()
    {
        return $this->getClassMetadata()->getIdentifier();
    }

    public function createModelFromString($value)
    {
        $map = json_decode($value, true);
        $ids = $this->getClassKeys();
        $objectMap = Array();
        foreach ($ids as $id) {
            $objectMap[$id] = $map[$id];
        }
        $em = \Faderim\Core\FaderimEngine::getInstance()->getEntityManager();
        $value = $em->find($this->repositoryName, $objectMap);
        //$value = $em->getReference($this->repositoryName, $objectMap);
        return $value;
    }

    public function objectToJson($object, $fields)
    {
        $values = Array();
        foreach ($fields as $field) {
            $name = $field->getName();
            $value = \Faderim\Bean\ModelBean::getModelProperty($object, $name);
            $values[$name] = $value;
        }
        return $values;
    }

    /*


      $this->keys = $metaData->getIdentifierFieldNames();
     */
}
