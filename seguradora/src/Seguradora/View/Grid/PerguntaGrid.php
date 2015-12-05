<?php

namespace Seguradora\View\Grid;

use Faderim\Ext\Field\GridField;
use Faderim\Ext\Field\TypeField;

/**
 * Description of PerguntaGrid
 *
 * @author Giorgio Fellipe
 */
class PerguntaGrid extends \Faderim\Framework\View\Grid\BaseViewGrid
{

    protected function createComponents()
    {
        $this->addChild(new GridField(TypeField::TYPE_NUMBER, 'id', 'Código', 0.1, true));

        $groupTipoPergunta = new \Faderim\Ext\Field\GroupField('Tipo de Pergunta');
        $groupTipoPergunta->addChild(new GridField(TypeField::TYPE_NUMBER, 'tipoPergunta/id', 'Id', 0.1, true, true));
        $groupTipoPergunta->addChild(new GridField(TypeField::TYPE_TEXT, 'tipoPergunta/descricao', 'Descrição', 250, true, true));
        $this->addChild($groupTipoPergunta);

        $this->addChild(new GridField(TypeField::TYPE_TEXT, 'descricao', 'Descrição', 0.4, true));

        $this->addChild(new GridField(TypeField::TYPE_NUMBER, 'porcentagem', 'Porcentagem', 0.1, true));

        $formaAplicarPorcentagem = $this->addChild(new GridField(TypeField::TYPE_LIST, 'formaAplicarPorcentagem', 'Forma de Aplicar Porcentagem', 0.2, true));
        $formaAplicarPorcentagem->getTypeField()->getLocalStore()->setEnumerator(\Seguradora\Model\Pergunta::getFormaAplicarPorcentagemLista());
        $this->setSortInitial('id','desc');
        $this->addActionAdd('seg_pergunta');
        $this->addActionEdit('seg_pergunta');
        $this->addActionDelete('seg_pergunta');
    }

    protected function getPageName()
    {
        return 'seg_pergunta_list';
    }

}
