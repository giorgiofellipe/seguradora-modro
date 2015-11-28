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
    
    public function buscaTipoSeguroRegiao(){
        $tipoSeguro = $this->getRequest()->getParameter('tipoSeguro');
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

}
