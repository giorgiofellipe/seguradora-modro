<?php

namespace Faderim\Ext;

/**
 * Description of FormPanel
 *
 * @author Ricardo
 */
class FormPanel extends Panel
{

    protected $labelWidth = 100;
    protected $labelAlign = 'right';

    protected function getExtClassName()
    {
        return 'Faderim.form.Panel';
    }

    protected function setDefaultProperties()
    {
        $this->setProperty('autoHeight', true);
        $this->setProperty('autoScroll', true);
        $this->setProperty('bodyPadding', '5');
        $this->setProperty('fieldDefaults', Array('msgTarget' => 'under',
            'labelWidth' => $this->labelWidth,
            'labelAlign' => $this->labelAlign,
            'xtype' => 'textfield'
        ));
    }

    public function getValues()
    {
        $values = Array();
        foreach ($this->getChilds() as $campo) {
            $nome = $campo->getName();
            $value = $campo->getModelValue();
            $values[$nome] = $value;
        }
        return $values;
    }

    protected function getDefaultButtons()
    {
        $oBtnSave = new Button('btn_save', 'Salvar');
        //$oBtnSave->getListener()->onClick('submitTela');
        $oBtnClear = new Button('btn_cancel', 'Cancelar');
        return Array($oBtnSave, $oBtnClear);
    }

    public function getLabelWidth()
    {
        return $this->labelWidth;
    }

    public function getLabelAlign()
    {
        return $this->labelAlign;
    }

    public function setLabelWidth($labelWidth)
    {
        $this->labelWidth = $labelWidth;
    }

    public function setLabelAlign($labelAlign)
    {
        $this->labelAlign = $labelAlign;
    }

}
