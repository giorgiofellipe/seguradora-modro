<?php

namespace Faderim\Core;
/**
 * Description of AbstractTemplateView
 *
 * @author Ricardo Schroeder
 */
abstract class AbstractTemplateView extends TemplateView
{
    public function __construct()
    {
        parent::__construct($this->getTemplateName());
        $this->createChilds();
    }
    abstract protected function getTemplateName();
    abstract protected function createChilds();
}
