<?php

namespace Faderim\Ext\Field;

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TextTypeField
 *
 * @author Rick
 */
class TypeFieldNumber extends TypeField
{

    public function __construct($name)
    {
        parent::__construct($name);
        $this->setCustomProperty('hideTrigger', true);
        //$this->setCustomProperty('format', '');
    }

    public function getExtType()
    {
        return 'Faderim.form.field.FieldNumber';
    }

    /*
      public function getExtTypeColumn()
      {
      return 'numbercolumn';
      } */

    public function setDecimal($decimal)
    {
        $this->setCustomProperty('precision', $decimal);
        $this->setCustomProperty('defaultZero', true);
        $this->setSeparadorDecimais();
        $this->setSeparadorMilhares();
    }

    public function getSeparadorDecimais()
    {
        return $this->getCustomProperty('decimal');
    }

    public function getSeparadorMilhares()
    {
        return $this->getCustomProperty('thousands');
    }

    public function setSeparadorDecimais($separador = ',')
    {
        $this->setCustomProperty('decimal', $separador);
    }

    public function setSeparadorMilhares($separador = '.')
    {
        $this->setCustomProperty('thousands', $separador);
    }

}
