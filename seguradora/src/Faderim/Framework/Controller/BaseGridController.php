<?php
namespace Faderim\Framework\Controller;

use Faderim\Core\FaderimReflectionClass;

/**
 * Description of BaseGridController
 *
 * @author Ricardo Schroeder
 */
abstract class BaseGridController extends BaseController
{

    protected function getGridRepository()
    {
        $em = $this->getEntityManager();
        $repository = $em->getRepository($this->getRepositoryName());
        return $repository;
    }

    protected function getObjectsFromRepository(\Doctrine\ORM\EntityRepository $repository)
    {
        return $repository->findAll();
    }

    protected function getObjects()
    {
        $repository = $this->getGridRepository();
        return $this->getObjectsFromRepository($repository);
    }
    
    abstract public function createGridAction();
    
    abstract protected function getRepositoryName();

    public function getDataAction()
    {
        $view = $this->createGridAction();
        $oStore = $view->getStore();
        $aData = Array();
        $objects = $this->getObjects();
        foreach ($objects as $currentModel) {
            $aDataAtual = Array();
            foreach ($oStore->getFields() as $oField) {
                $sProp = $oField->getName();
                $aDataAtual[$sProp] = FaderimReflectionClass::callGetter($currentModel, $sProp);
            }
            $aData[] = $aDataAtual;
        }
        return new \Faderim\Core\JsonResponse($aData);
    }
}
