<?php

namespace Faderim\Framework\Controller;

use Faderim\Core\FaderimEngine;
use Faderim\Core\IRequest;

/**
 * Description of BaseController
 *
 * @author Ricardo Schroeder
 */
abstract class BaseController
{

    public function __construct()
    {
        
    }

    /*
      public function __construct(IRequest $request)
      {
      $this->request = $request;
      }
     */

    /**
     *
     * @return \Doctrine\ORM\EntityManager
     */
    protected function getEntityManager()
    {
        return $this->getEngine()->getEntityManager();
    }

    /**
     * @return FaderimEngine
     */
    protected function getEngine()
    {
        return FaderimEngine::getInstance();
    }

    protected function throwException($message)
    {
        throw new \Exception($message);
    }

    /**
     *
     * @return \Faderim\Core\HttpRequest
     */
    protected function getRequest()
    {
        return $this->getEngine()->getRequest();
    }

    /**
     *
     * @return \Faderim\Core\SessionManager
     */
    protected function getSession()
    {
        return $this->getEngine()->getSession();
    }

    /**
     *
     * @return \Faderim\Framework\Model\Router
     */
    protected function getRouter()
    {
        return $this->getEngine()->getRouter();
    }

}
