<?php

namespace Faderim\Ext;

/**
 * Description of GridForm
 *
 * @author Rodrigo Cândido
 */
class GridForm extends Container
{

    /**
     *
     * @var \Faderim\Bean\FormBean
     */
    protected $formBean;
    protected $childsValidateDuplicate = Array();

    protected function getExtClassName()
    {
        return 'Faderim.view.GridForm';
    }

    public function setLinhasIniciais($linha)
    {
        $this->setProperty('initRow', $linha);
    }

    public function setValor($valor)
    {
        $this->setProperty('data', $valor);
    }

    public function getValor()
    {
        return $this->getProperty('data');
    }

    protected function getExtProperties()
    {
        $s = \Faderim\Json\Json::encode($this->getChilds());
        $t = new \Faderim\Json\ClosureJson(function() use ($s) {
            return 'function() { return ' . $s . ' }';
        });
        $this->setProperty($this->itemsProp, $t);
        $this->loadChildsValidadeDuplicate();
        return parent::getExtProperties();
    }

    final protected function loadChildsValidadeDuplicate()
    {
        if (count($this->getChildsValidateDuplicate())) {
            $validate = Array();
            foreach ($this->getChildsValidateDuplicate() as $child) {
                $validate[] = $child->getName();
            }
            $this->setProperty('childsValidateDuplicate', \Faderim\Json\Json::encode($validate));
        }
    }

    public function validateRegister($class)
    {

    }

    public function beanModel($model)
    {
        $metadata = \Faderim\Core\FaderimEngine::getInstance()->getEntityManager()->getClassMetadata(get_class($model));
        $methodNew = $metadata->getReflectionClass()->getMethod('new' . $this->getName());
        if ($methodNew) {
            $values = $this->getValor();
            /* @var $currentRows \Doctrine\Common\Collections\ArrayCollection */
            $currentRows = \Faderim\Core\FaderimReflectionClass::callGetter($model, $this->getName());
            if (is_array($values)) {
                $tempRows = new \Doctrine\Common\Collections\ArrayCollection();
                \Faderim\Core\FaderimReflectionClass::callSetter($model, $this->getName(), Array($tempRows));
                foreach ($values as $key => $row) {
                    //vamos buscar o identificador desta classe
                    $childModel = $methodNew->invoke($model);
                    $this->setValoresInRow($row, $childModel);
                    $id = $this->getIndentificadorClasse($childModel);
                    foreach ($currentRows as $idx => $atual) {
                        $temp = $this->getIndentificadorClasse($atual);
                        if ($temp == $id) {
                            $this->setValoresInRow($row, $atual);
                            $tempRows->set($key, $atual);
                            $currentRows->remove($idx);
                            break;
                        }
                    }
                }
                foreach ($currentRows as $delete) {
                    \Faderim\Core\FaderimEngine::getInstance()->getEntityManager()->remove($delete);
                }
            }
        } else {
            throw new \Exception('Não localizado o método "' . 'new' . $this->getName() . '" na classe ' . get_class($model));
        }
    }

    private function setValoresInRow($row, $model)
    {

        foreach ($row as $method => $value) {
            $campo = $this->findChild($method);
            /**
             * @todo Adicionado paretn para tratamento o dos filhos do SuggestContainer, verificar se isto ira ficar assim
             * @todo Campo retorna null quando busca o valor de um filho do SuggestContainer
             */
            if ($campo == null || $campo->getParent() instanceof Form\SuggestContainer) {
                continue;
            }
            if ($campo instanceof Form\SuggestContainer) {
                \Faderim\Core\FaderimReflectionClass::callSetter($model, $method, Array($value));
            } else if ($campo !== null) {
                $campo->setValue($value);
                \Faderim\Core\FaderimReflectionClass::callSetter($model, $method, Array($campo->getModelValue()));
            }
        }
    }

    private function getIndentificadorClasse($class)
    {
        $identificadores = Array();
        $metaChild = \Faderim\Core\FaderimEngine::getInstance()->getEntityManager()->getClassMetadata(get_class($class));
        $ids = $metaChild->getIdentifierValues($class);
        foreach ($ids as $name => $id) {
            if (is_object($id)) {
                $identificadores = array_merge($identificadores, $this->getIndentificadorClasse($id));
            } else {
                $identificadores[$name] = $id;
            }
        }
        return $identificadores;
    }

    public function beanForm($model)
    {
        $models = \Faderim\Core\FaderimReflectionClass::callGetter($model, $this->getName());
        $data = Array();
        foreach ($models as $modelRow) {
            $data[] = $this->beanFormRow($modelRow);
        }
        $this->setValor($data);
    }

    private function beanFormRow($model, $campo = null)
    {
        $row = Array();
        $childs = ($campo instanceof Container) ? $campo->getChilds() : $this->getChilds();
        foreach ($childs as $campo) {
            //suggest precisamos de um tratamento
            if ($campo instanceof Form\SuggestContainer) {
                $name = $this->getFormBean()->getMappingProperty($campo->getName(), $this->getName());
                if ($name !== null) {
                    $modelSuggest = \Faderim\Bean\ModelBean::getModelProperty($model, $name);
                    $campo->setModelValue($modelSuggest);
                    $row[$campo->getName()] = $campo->getObjectToJson();
                    $campo->setModelValue(null);
                }
            } else if ($campo instanceof Container) {
                $row = array_merge($this->beanFormRow($model, $campo), $row);
            } else {
                $name = $this->getFormBean()->getMappingProperty($campo->getName(), $this->getName());
                if ($name !== null) {
                    $row[$name] = \Faderim\Bean\ModelBean::getModelProperty($model, $name);
                }
            }
        }
        return $row;
    }

    public function beanRequest($request)
    {
        if ($request->hasParameter($this->getName())) {
            $param = json_decode($request->getParameter($this->getName()));
            foreach ($param as $key => $row) {
                foreach ($row as $childName => $value) {
                    $child = $this->findChild($childName);
                    if ($child == null) {
                        continue;
                    }
                    if ($child instanceof Form\SuggestContainer) {
                        if (!empty($value)) {
                            $child->setRequestValue($value);
                            $value = $child->getValue();
                            $param[$key]->$childName = $value;
                        }
                        //encontramos um valor obrigatório não preenchido, temos que eliminar essa linha
                    } else if ($child->getRequired() && empty($value)) {
                        unset($param[$key]);
                        break;
                    }
                }
            }
            $this->setValor($param);
        } else {
            $this->setValor(null);
        }
    }

    public function getFormBean()
    {
        return $this->formBean;
    }

    public function setFormBean($formBean)
    {
        $this->formBean = $formBean;
    }

    public function create()
    {
        //temos que tratar os valores setados para este campo
        $valor = $this->getValor();
        if ($valor !== null) {
            $valores = Array();
            $iterator = new \Faderim\Core\ContainerIterator($this);
            foreach ($valor as $linha) {
                foreach ($iterator as $campo) {
                    $name = $campo->getName();
                    if ($campo instanceof Field\FormField && isset($linha[$name])) {
                        $linha[$name] = $campo->getTypeField()->parseSetModelValue($linha[$name]);
                    }
                }
                $valores[] = $linha;
            }
            $this->setValor($valores);
        }
        return parent::create();
    }

    public function addChildValidateDuplicate($child)
    {
        $this->childsValidateDuplicate[] = $child;
    }

    public function addChildsValidateDuplicate()
    {
        $args = func_get_args();
        foreach ($args as $argAtual) {
            $this->addChildValidateDuplicate($argAtual);
        }
    }

    protected function getChildsValidateDuplicate()
    {
        return $this->childsValidateDuplicate;
    }

}
