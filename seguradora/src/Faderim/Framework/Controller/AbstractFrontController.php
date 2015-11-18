<?php

namespace Faderim\Framework\Controller;

use Faderim\Framework\Model\Router;
use Faderim\Core\IFrontController;

/**
 * Classe base para implementação de front-controllers e sua renderização
 *
 * @author Ricardo Schroeder <ricardo@magamobi.com.br>
 */
abstract class AbstractFrontController extends BaseController implements IFrontController
{

    /**
     * @var Router
     */
    protected $router;

    abstract protected function hasAccess();

    protected function noAccessRender()
    {
        $this->throwException('Forbidden');
    }

    abstract protected function findRouter();

    protected function renderRouter()
    {
        $factory = $this->router->getInstanceController();
        if (null === $factory) {
            $this->throwException('No controller defined for router ' . $this->router->getName());
        }
        if ($this->hasAccess() === false) {
            $this->noAccessRender();
        } else {
            $controllerInstance = $factory->instance();
            if ($factory->getDefaultMethod()) {
                $view = $factory->callDefaultMethod($controllerInstance, $this->router->getParams());
                $this->renderView($view);
            }
        }
    }

    protected function renderView($view)
    {
        if ($view instanceof \Faderim\Core\IBaseView) {
            echo $view->render();
        } else if ($view instanceof \Faderim\Json\JsonSerializable) {
            header('Content-type: application/json; charset=utf-8');
            echo $view->getJsonFormat();
        }
    }

    public function render()
    {
        $router = $this->findRouter();
        if ($router) {
            $this->router = $router;
            $this->getEngine()->setRouter($router);
            $this->renderRouter();
        } else {
            $this->throwException('Not found');
        }
    }

}
