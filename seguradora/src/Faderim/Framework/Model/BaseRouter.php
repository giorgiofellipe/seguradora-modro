<?php

namespace Faderim\Framework\Model;

/**
 * Description of AbstractRouter
 *
 * @author Ricardo Schroeder <ricardo@magamobi.com.br>
 */
class BaseRouter
{

    protected $controllerName;
    protected $params;

    public function getControllerName()
    {
        return $this->controllerName;
    }

    public function setControllerName($controllerName)
    {
        $this->controllerName = $controllerName;
    }

    /**
     *
     * @return \Faderim\Core\FaderimReflectionClass
     */
    public function getInstanceController()
    {
        if (empty($this->controllerName)) {
            return null;
        }
        if (!isset($this->instanceController)) {
            $this->instanceController = $this->getNewInstanceController();
        }
        return $this->instanceController;
    }

    public function getNewInstanceController()
    {
        return new \Faderim\Core\FaderimReflectionClass($this->controllerName);
    }

    public function getParams()
    {
        return $this->params;
    }

    public static function link($dir)
    {
        return ($_SERVER['SCRIPT_NAME']) . (substr($dir, 0, 1) == '/' ? $dir : '/' . $dir);
    }

}
