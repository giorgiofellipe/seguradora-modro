<?php

namespace Faderim\Framework\Controller;

/**
 * Description of BaseFormController
 *
 * @author Rodrigo Cândido
 */
abstract class BaseFormController extends \Faderim\Framework\Controller\BaseController
{

    private $View = null;
    private $Model = null;

    /**
     * @var \Faderim\Bean\FormBean
     */
    private $FormBean = null;

    abstract protected function createInstanceView();

    abstract protected function createInstanceModel();

    /**
     *
     * @return \Faderim\Ext\AbstractForm
     */
    public function getView()
    {
        if ($this->View === null) {
            $this->View = $this->createInstanceView();
        }
        return $this->View;
    }

    public function getModel()
    {
        if ($this->Model === null) {
            $this->Model = $this->createInstanceModel();
        }
        return $this->Model;
    }

    protected function createInstanceFormBean()
    {
        return new \Faderim\Bean\FormBean();
    }

    protected function getFormBean()
    {
        if ($this->FormBean === null) {
            $this->FormBean = $this->createInstanceFormBean();
        }
        return $this->FormBean;
    }

    /**
     * Invoca os métodos do beanRequest e beanModel
     */
    protected function beanPost()
    {
        $this->beanRequest();
        $this->beanModel();
    }

    /**
     * seta os valores da tela para o modelo
     */
    protected function beanModel()
    {
        $this->getFormBean()->beanModel($this->getModel(), $this->getView());
    }

    /**
     * seta os valores do post para a tela
     */
    protected function beanRequest()
    {
        $this->getFormBean()->beanRequest($this->getRequest(), $this->getView());
    }

    /**
     * Atribui os valores do model para a tela
     */
    protected function beanForm()
    {
        $this->getFormBean()->beanForm($this->getModel(), $this->getView());
    }

    protected function getRows()
    {
        return $this->getRequest()->getJsonParameter('rows');
    }

    public function edit()
    {
        $rows = $this->getRows();
        if ($this->getRequest()->isPost()) {
            try {
                $this->getEntityManager()->beginTransaction();
                $this->editPost();
                $this->getEntityManager()->commit();
                $success = true;
                $msg = $this->getMsgEditSucess();
            } catch (\Exception $ex) {
                $success = false;
                $msg = $ex->getMessage();
            }
            $event = new \Faderim\Core\EventResponse($msg, $success);
            $event->setResetCaller(true);
            $event->setClose(true);
            return $event;
        } else if (isset($rows[0])) {
            //load model selected for edition
            $this->loadModelByKeys($rows[0]);
            //load data in view of edition
            $this->beanForm();
            return $this->getView();
        }
    }

    protected function editPost()
    {
        $this->loadModelByKeys($this->getRequest()->getValues());
        $this->beanPost();
        $this->getEntityManager()->persist($this->getModel());
        $this->getEntityManager()->flush();
    }

    public function view()
    {
        $rows = $this->getRows();
        if (isset($rows[0])) {
            //load model selected for edition
            $this->loadModelByKeys($rows[0]);
            //load data in view of edition
            $this->beanForm();
            return $this->getView();
        }
    }

    protected function addPost()
    {
        $this->beanPost();
        $this->getEntityManager()->persist($this->getModel());
        $this->getEntityManager()->flush();
    }

    public function add()
    {
        if ($this->getRequest()->isPost()) {
            try {
                $this->getEntityManager()->beginTransaction();
                $this->addPost();
                $this->getEntityManager()->commit();
                $success = true;
                $msg = $this->getMsgAddSucess();
            } catch (\Exception $ex) {
                $success = false;
                $msg = $ex->getMessage();
            }
            $event = new \Faderim\Core\EventResponse($msg, $success);
            $event->setReset(true);
            $event->setResetCaller(true);
            return $event;
        } else {
            return $this->getView();
        }
    }

    public function delete()
    {
        $rows = $this->getRows();
        try {
            $this->getEntityManager()->beginTransaction();
            $models = $this->getModelsByKeys($rows);
            foreach ($models as $model) {
                $this->getEntityManager()->remove($model);
            }
            $this->getEntityManager()->flush();
            $this->getEntityManager()->commit();
            $success = true;
            $msg = $this->getMsgDeleteSucess();
        } catch (\Exception $ex) {
            $success = false;
            $msg = $ex->getMessage();
            $this->getEntityManager()->rollback();
        }
        $action = new \Faderim\Core\EventResponse($msg, $success);
        $action->setResetCaller(true);
        return $action;
    }

    final protected function getModelsByKeys(Array $keys)
    {
        $models = Array();
        foreach ($keys as $multiKey) {
            $models[] = $this->createModelByKeys($multiKey);
        }
        return $models;
    }

    final protected function createModelByKeys(Array $keys)
    {
        $objectId = Array();
        $className = get_class($this->getModel());
        $classId = $this->getClassIdentifiers();
        foreach ($classId as $id) {
            if (isset($keys[$id])) {
                $val = $keys[$id];
                $objectId[$id] = $val;
            } else {
                throw new \Exception('Não identificado o id (' . $id . ') para a Classe (' . $className . ')');
            }
        }
        return $this->getEntityManager()->getReference($className, $objectId);
    }

    /**
     * Carrega o modelo a partir de um array contendo as chaves.
     * Todos os identificadores da classe atual tem que serem passados como parametros
     * @param array $keys
     * @throws \Exception
     */
    final protected function loadModelByKeys(Array $keys)
    {
        $this->Model = $this->createModelByKeys($keys);
    }

    protected function getClassIdentifiers()
    {
        $className = get_class($this->getModel());
        $metaData = $this->getEntityManager()->getClassMetadata($className);
        return $metaData->getIdentifierFieldNames();
    }

    /**
     * Retorna a mensagem a ser exibida caso a operação de adição tenha sido efetuada com sucesso
     * @return string
     */
    protected function getMsgAddSucess()
    {
        return 'Registro inserido com sucesso.';
    }

    /**
     * Retorna a mensagem a ser exibida caso a operação de edição tenha sido efetuada com sucesso
     * @return string
     */
    protected function getMsgEditSucess()
    {
        return 'Registro alterado com sucesso.';
    }

    /**
     * Retorna a mensagem a ser exibida caso a operação de delete tenha sido efetuada com sucesso
     * @return string
     */
    protected function getMsgDeleteSucess()
    {
        return 'Registro(s) excluído(s) com sucesso.';
    }

}
