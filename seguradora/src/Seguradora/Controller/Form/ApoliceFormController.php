<?php

namespace Seguradora\Controller\Form;

/**
 * Description of ApoliceFormController
 *
 * @author Rodrigo Cândido
 */
class ApoliceFormController extends \Faderim\Framework\Controller\BaseFormController
{

    protected function createInstanceModel()
    {
        return new \Seguradora\Model\Apolice();
    }

    protected function createInstanceView()
    {
        return new \Seguradora\View\Form\ApoliceForm();
    }
    
    protected function createInstanceFormBean() {
        $bean = parent::createInstanceFormBean();
        $bean->addMappingProperty('tipoSeguroRegiao', null);
        return $bean;
    }
    /**
     * 
     * @return \Seguradora\Model\Apolice
     */
    public function getModel() {
        return parent::getModel();
    }
    
    protected function beanModel() {
        parent::beanModel();
        $idTipoSeguroRegiao = $this->getView()->findChild('tipoSeguroRegiao')->getModelValue();
        $tipoSeguroRegiao = null;
        if($idTipoSeguroRegiao){
            $tipoSeguroRegiao = $this->getEntityManager()->getRepository('Seguradora\Model\TipoSeguroRegiao')->find($idTipoSeguroRegiao);            
        }
        $this->getModel()->setTipoSeguroRegiao($tipoSeguroRegiao);        
        if(!$this->getModel()->getValorPremio()){
            $this->getModel()->setValorPremio(0);
        }
    }
    
    protected function beanForm() {
        parent::beanForm();
        if($this->getModel()->getTipoSeguroRegiao()){
            $list = Array();
            foreach($this->getModel()->getTipoSeguro()->getTipoSeguroRegiao() as $tipoSeguroRegiao){
                $list[$tipoSeguroRegiao->getId()] = $tipoSeguroRegiao->getDescricaoList();
            }
            if(count($list) == 0){
                $this->getView()->findChild('tipoSeguroRegiao')->setHidden();
            } else {
                $this->getView()->findChild('tipoSeguroRegiao')->getTypeField()->getLocalStore()->setEnumerator(new \Faderim\Util\Enumerator($list));
                $this->getView()->findChild('tipoSeguroRegiao')->setModelValue($this->getModel()->getTipoSeguroRegiao()->getId());
            }            
        }
    }
    
    public function buscaTipoSeguroRegiao($tipoSeguro = null){
        $tipoSeguro = $this->getRequest()->getParameter('tipoSeguro',$tipoSeguro);
        /* @var $tipoSeguro \Seguradora\Model\TipoSeguro */
        $tipoSeguro = $this->getEntityManager()->getRepository('Seguradora\Model\TipoSeguro')->find($tipoSeguro);
        $list = false;
        if($tipoSeguro && $tipoSeguro->getTipoSeguroRegiao()->count() > 0){
            $list = Array();
            foreach($tipoSeguro->getTipoSeguroRegiao() as $tipoSeguroRegiao){
                $list[] = Array('val'=>$tipoSeguroRegiao->getId(),'name'=>$tipoSeguroRegiao->getDescricaoList());
            }
        } 
        return new \Faderim\Core\JsonResponse(Array('regiao'=>$list));
    }

    protected function addPost() {
        $this->beanPost();
        /* @var $perguntas \Seguradora\Model\Pergunta[] */
        $perguntas = $this->getEntityManager()->getRepository('\Seguradora\Model\Pergunta')->findAll();
        foreach ($perguntas as $pergunta) {
            if($pergunta->isTipoSeguro($this->getModel()->getTipoSeguro())){
                $apolicePergunta = $this->getModel()->newApolicePergunta();
                $apolicePergunta->setPergunta($pergunta);
                $apolicePergunta->setTipoPergunta($pergunta->getTipoPergunta());
                $apolicePergunta->setDescricao($pergunta->getDescricao());
                $apolicePergunta->setPorcentagem($pergunta->getPorcentagem());
                $apolicePergunta->setFormaAplicarPorcentagem($pergunta->getFormaAplicarPorcentagem());
            }
        }
        $this->getEntityManager()->persist($this->getModel());
        $this->getEntityManager()->flush();
    }    
}
