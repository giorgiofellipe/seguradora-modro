<?php

namespace Faderim\Core;

/**
 * Description of TemplateView
 *
 * @author Ricardo Schroeder
 */
class TemplateView implements IBaseView
{

    private $templateName;
    private $parameters = Array();

    public function __construct($templateName)
    {
        $this->setTemplateName($templateName);
    }

    public function setTemplateName($templateName)
    {
        $this->templateName = $templateName;
    }
    
    public function setParameter($paramName,$paramValue)
    {
        $this->parameters[$paramName] = $paramValue;
    }
    
    public function getParameter($paramName)
    {
        return $this->parameters[$paramName];
    }

    public function render()
    {
        return FaderimEngine::getInstance()->getTemplateEngine()->render($this->templateName,$this->parameters);
    }
}
