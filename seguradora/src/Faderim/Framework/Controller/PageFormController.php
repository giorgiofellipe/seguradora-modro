<?php

namespace Faderim\Framework\Controller;

/**
 * Description of PageFormController
 *
 * @author Rodrigo
 */
class PageFormController extends \Faderim\Framework\Controller\BaseFormController
{

    protected function createInstanceModel()
    {
        return new \Faderim\Framework\Model\Page();
    }

    protected function createInstanceView()
    {
        return new \Faderim\Framework\View\Form\PageForm();
    }

    protected function createInstanceFormBean()
    {
        $oFormBean = parent::createInstanceFormBean();
        //$oFormBean->addMappingProperty('system', null);
        return $oFormBean;
    }

    protected function beanPost()
    {
        parent::beanPost();
        /*
          $system = $this->getEntityManager()->find('\Faderim\Framework\Model\System', $this->getRequest()->getParameter('system'));
          $this->getModel()->setSystem($system); */
    }

    /*
      protected function beanForm()
      {
      parent::beanForm();
      $this->getView()->findChild('system')->setValue($this->getModel()->getSystem()->getId());
      } */

    /* public function beanTeste($form, $model)
      {
      $this->getFormBean()->beanRequest($this->getRequest(), $this->getView());
      foreach ($form->getChilds() as $campo) {
      $value = $campo->getModelValue();
      self::callProperty($model, $campo->getName(), 'set', Array($value));
      }
      }

      public function callProperty($object, $name, $type, $args = Array())
      {
      $metaData = $this->getEntityManager()->getClassMetadata(get_class($object));
      if ($metaData->isAssociationWithSingleJoinColumn($name)) {
      $class = $metaData->getAssociationTargetClass($name);
      $metaDataNew = $this->getEntityManager()->getClassMetadata($class);
      $keys = $metaDataNew->getIdentifierColumnNames();
      foreach ($keys as $key) {
      if (isset($args[$key])) {
      \Faderim\Core\FaderimReflectionClass::callMethod($object, 'set' . ucfirst($key), Array($args[$key]));
      }
      }
      } else {
      \Faderim\Core\FaderimReflectionClass::callMethod($object, $type . ucfirst($name), Array($value));
      }
      } */
}
