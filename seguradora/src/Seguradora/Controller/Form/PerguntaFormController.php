<?php

namespace Seguradora\Controller\Form;

/**
 * Description of PerguntaFormController
 *
 * @author Giorgio Fellipe
 */
class PerguntaFormController extends \Faderim\Framework\Controller\BaseFormController
{

    protected function createInstanceModel()
    {
        return new \Seguradora\Model\Pergunta();
    }

    protected function createInstanceView()
    {
        if ($this->getRouter()->getName() == 'seg_pergunta_answer') {
            $rows = $this->getRows();
            $apolice = $this->getEntityManager()->find('\Seguradora\Model\Apolice', $rows[0]['id']);
            $view = new \Seguradora\View\Form\QuestionarioForm($apolice);
        } else {
            $view = new \Seguradora\View\Form\PerguntaForm();
        }
        return $view;
    }

    public function answer() {
        if ($this->getRequest()->isPost()) {
            try {
                $this->getEntityManager()->beginTransaction();
                /* @var $apolice \Seguradora\Model\Apolice */
                $apolice = null;
                
                //gambiarra do caralho
                $values = $this->getRequest()->getValues();
                foreach ($values as $key => $value) {
                    if (strchr($key, "apolicePergunta_") !== false) {
                        $id = str_replace("apolicePergunta_", "", $key);
                        
                        /** @var \Seguradora\Model\ApolicePergunta */
                        $apolicePergunta = $this->getEntityManager()->find("\Seguradora\Model\ApolicePergunta", $id);
                        
                        if ($apolice == null) {
                            $apolice = $apolicePergunta->getApolice();
                        }
                        
                        if ($value == "on") {
                            $apolicePergunta->setResposta(true);
                        } else {
                            $apolicePergunta->setResposta(false);
                        }
                        
                        $this->getEntityManager()->persist($apolicePergunta);
                    }
                }
                
                $percentualPremio = $apolice->getTipoSeguroRegiao()->getPorcentagem();
                
                foreach ($apolice->getApolicePerguntas() as $apolicePergunta) {
                    //sempre que respondermos novamente vamos buscar os mais novos valores da pergunta
                    //para que em caso de atualizacao de valores não fique incorreto o cálculo
                    $pergunta = $apolicePergunta->getPergunta();
                    $apolicePergunta->setTipoPergunta($pergunta->getTipoPergunta());
                    $apolicePergunta->setDescricao($pergunta->getDescricao());
                    $apolicePergunta->setPorcentagem($pergunta->getPorcentagem());
                    $apolicePergunta->setFormaAplicarPorcentagem($pergunta->getFormaAplicarPorcentagem());
                    
                    if ($apolicePergunta->getResposta() == null) {
                        $apolicePergunta->setResposta(false);
                    }
                    
                    if ($apolicePergunta->getResposta() == true) {
                        if ($apolicePergunta->getFormaAplicarPorcentagem() == \Seguradora\Model\Pergunta::FORMA_APLICAR_PORCENTAGEM_ACRESCENTAR) {
                            $percentualPremio += $apolicePergunta->getPorcentagem();
                        } else {
                            $percentualPremio -= $apolicePergunta->getPorcentagem();
                        }
                    }
                    
                    $this->getEntityManager()->persist($apolicePergunta);
                }
                $valorPremio = $apolice->getValorBem() * $percentualPremio / 100;
                //vamos adicionar o bônus
                if($apolice->getPercentualPremio()){
                    $valorPremio = + $valorPremio - ($valorPremio * $apolice->getPercentualPremio() / 100) ;
                }
                $apolice->setValorPremio($valorPremio);
                $this->getEntityManager()->persist($apolice);
                
                $this->getEntityManager()->flush();
                $this->getEntityManager()->commit();
                $success = true;
                $msg = $this->getMsgAddSucess();
            } catch (\Exception $ex) {
                $success = false;
                $msg = $ex->getMessage();
            }
            $event = new \Faderim\Core\EventResponse($msg, $success);            
            $event->setResetCaller(true);
            $event->setClose(true);
            return $event;
        } else {
            return $this->getView();
        }
    }
}
