<?php

namespace Faderim\Twig;

use Faderim\Json\Json;

/**
 * Description of JsonExtension
 *
 * @author Ricardo Schroeder
 */
class Extension extends \Twig_Extension
{

    public function getFunctions()
    {
        return array(
            'web_path' => new \Twig_Function_Method($this, 'webPath'),
            'web_link' => new \Twig_Function_Method($this, 'webLink'),
            'web_router' => new \Twig_Function_Method($this, 'webRouter'),
        );
    }

    public function getFilters()
    {
        return array(
            'faderim_json' => new \Twig_Filter_Method($this, 'jsonEncode'),
        );
    }

    public function webPath($sDir = '')
    {
        $dir = dirname($_SERVER['SCRIPT_NAME']);
        return '//' . $_SERVER['HTTP_HOST'] . ($dir === DIRECTORY_SEPARATOR ? '/' . $sDir : $dir . '/' . $sDir);
    }

    public function webRouter($routerName, Array $params = null)
    {
        $em = \Faderim\Core\FaderimEngine::getInstance()->getEntityManager();
        $router = $em->find('Faderim\Framework\Model\Router', $routerName);
        if ($router) {
            return $this->webLink($router->getLink($params));
        }
    }

    public function webLink($sDir)
    {
        return ($_SERVER['SCRIPT_NAME']) . (substr($sDir, 0, 1) == '/' ? $sDir : '/' . $sDir);
    }

    public function jsonEncode($var)
    {
        return Json::encode($var);
    }

    public function getName()
    {
        return 'faderim_extension';
    }

}
