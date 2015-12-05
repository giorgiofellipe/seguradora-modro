<?php

namespace Seguradora\View\Form;

use Faderim\Ext\Field as Field;
use Faderim\Ext\Field\TypeField;

/**
 * Description of QuestionarioForm
 *
 * @author Giorgio Fellipe
 */
class QuestionarioForm extends \Faderim\Ext\AbstractForm
{
    /**
     * @var \Seguradora\Model\Apolice
     */
    protected $apolice;
    
    public function getApolice() {
        return $this->apolice;
    }

    public function setApolice(\Seguradora\Model\Apolice $apolice) {
        $this->apolice = $apolice;
    }


    public function __construct(\Seguradora\Model\Apolice $apolice) {
        $this->setApolice($apolice);
        parent::__construct();
    }

    protected function createChilds()
    {
        $this->setWidth(900);

        $id = new Field\FormField(TypeField::TYPE_NUMBER, 'id', 'Código', false, 13);
        $id->setReadOnly(true);
        $id->setHidden();
        $id->setLabelWidth(200);
        $this->addChild($id);
        
        $apolice = $this->getApolice();
        $apolicePerguntas = $apolice->getApolicePerguntas();
        if (!count($apolicePerguntas)) {
            throw new \Exception('Não há perguntas relacionadas à esta Apólice!');
        }
        
        $tipoPerguntaAnterior = null;
        foreach ($apolicePerguntas as $apolicePergunta) {
            if ($tipoPerguntaAnterior != $apolicePergunta->getTipoPergunta()) {
                $tipoPerguntaAnterior = $apolicePergunta->getTipoPergunta();
                $tipoPergunta = new Field\FormField(TypeField::TYPE_TEXT, 'tipoPergunta_'.$tipoPerguntaAnterior->getId(), '', false);
                $tipoPergunta->setModelValue($tipoPerguntaAnterior->getDescricao());
                $tipoPergunta->setReadOnly(true);
                $this->addChild($tipoPergunta);
            }
            $pergunta = new Field\FormField(TypeField::TYPE_CHECKBOX, 'apolicePergunta_'.$apolicePergunta->getId(), $apolicePergunta->getDescricao(), false, 13);
            //temos que corrigir o layout
            $pergunta->setLabelWidth(850);
            $this->addChild($pergunta);
        }

    }

    protected function getFormName()
    {
        return 'form_questionario';
    }

}
