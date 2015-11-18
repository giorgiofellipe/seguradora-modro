<?php

namespace Faderim\Twig;

/**
 * Description of Engine
 *
 * @author Ricardo Schroeder
 * @todo Implementar cache
 */
class TwigEngine
{

    /**
     *
     * @var \Twig_Environment
     */
    private $TwigInstance = null;

    public function init()
    {
        $loader = new Loader();
        //$loader = new Twig_Loader_String();
        $this->TwigInstance = new \Twig_Environment($loader, $this->getDefaultOptions());

        $this->TwigInstance->addExtension(new Extension());
        $this->TwigInstance->addGlobal('app', \Faderim\Core\FaderimEngine::getInstance());
    }

    protected function getDefaultOptions()
    {
        $appConfig = \Faderim\Core\FaderimEngine::getInstance()->getAppConfig();
        return $appConfig['twig'];
    }

    /**
     *
     * @param String $name Name of template to render
     * @param array $context
     * @return String
     */
    public function render($name, array $context = array())
    {
        return $this->TwigInstance->render($name, $context);
    }

}
