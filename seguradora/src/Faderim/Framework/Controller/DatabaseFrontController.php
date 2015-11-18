<?php

namespace Faderim\Framework\Controller;

use Faderim\Core\IFrontController;
use Faderim\Core\IBaseView;
use Faderim\Framework\Model\Router;

/**
 * Description of DatabaseFrontController
 *
 * @author Ricardo Schroeder
 */
class DatabaseFrontController extends AbstractFrontController implements IFrontController
{

    private function getRouterRepository()
    {
        return $this->getEntityManager()->getRepository('Faderim\Framework\Model\Router');
    }

    private function getRouterByName($routerName)
    {
        $router = $this->getRouterRepository()->find($routerName);
        $action = $this->getRequest()->getParameter('action');
        if (null != $action and null != $router->getInstanceController()) {
            $router->getInstanceController()->setDefaultMethod($action);
        }
        return $router;
    }

    protected function getRouterByPath($path)
    {
        return $this->getRouterRepository()->findByPath($path);
    }

    protected function findRouter()
    {
        $request = $this->getRequest();
        $routerName = $request->getParameter('router');
        if (null !== $routerName) {
            return $this->getRouterByName($routerName);
        } else {
            return $this->getRouterByPath($request->getPath());
        }
    }

    protected function renderView($view)
    {
        if ($view instanceof \Faderim\Ext\Component) {
            $view->setTitle($this->router->getTitle());
        }
        parent::renderView($view);
    }

    protected function hasAccess()
    {
        return true;
    }

}
