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
                
                foreach ($apolice->getApolicePerguntas() as $apolicePergunta) {
                    if ($apolicePergunta->getResposta() == null) {
                        $apolicePergunta->setResposta(false);
                    }
                    $this->getEntityManager()->persist($apolicePergunta);
                }
                
                $this->getEntityManager()->flush();
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
            $event->setClose(true);
            return $event;
        } else {
            return $this->getView();
        }
    }
}
