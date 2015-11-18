<?php

namespace Faderim\Framework\View\Form;


/**
 * Description of BaseViewForm
 *
 * @author Ricardo
 */
abstract class AbstractViewForm extends \Faderim\Ext\FormPanel {

    final public function __construct() {
        parent::__construct($this->getFormName());
        $this->createComponents();
    }

    abstract protected function getFormName();

    abstract protected function createComponents();
}