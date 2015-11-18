<?php

namespace Faderim\Core;

use Composer\Autoload\ClassLoader;
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

class FaderimEngine
{

    /**
     * @var \Faderim\Core\FaderimEngine
     */
    protected static $instance;

    /*
     * @var \Faderim\Framework\Controller\Front
     */
    private $frontController;

    /**
     * @var \SplClassLoader
     */
    private $loader;

    /**
     * @var EntityManager
     */
    private $entityManager = null;

    /**
     * @var \Faderim\Twig\TwigEngine
     */
    private $templateEngine = null;

    /**
     * @var SessionManager
     */
    private $sessionManager = null;

    /**
     * @var \Faderim\Framework\Model\Router
     */
    private $router;

    /**
     * @var IRequest
     */
    private $request = null;

    /**
     * @var array
     */
    private $appConfig = null;

    /**
     * @var \Doctrine\Common\Cache\Cache
     */
    private $cache;

    protected function __construct()
    {

    }

    public function getAppConfig()
    {
        if (null === $this->appConfig) {
            $this->appConfig = \Faderim\Util\ConfigReader::readDefaultConfig('app');
            date_default_timezone_set($this->appConfig['date']['timezone']);
        }
        return $this->appConfig;
    }

    /**
     * @return \Faderim\Core\FaderimEngine
     */
    static public function getInstance()
    {
        if (!isset(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function setFrontController(IFrontController $oFront)
    {
        $this->frontController = $oFront;
    }

    public function engineStart()
    {
        $this->initHandlers();
        if (isset($this->frontController)) {
            $this->frontController->render();
        }
    }

    private function createTemplateEngine()
    {
        $this->templateEngine = new \Faderim\Twig\TwigEngine();
        $this->templateEngine->init();
    }

    private function createEntityManager()
    {
        $app = $this->getAppConfig();
        $doctrineConfig = $app['doctrine'];
        $config = Setup::createAnnotationMetadataConfiguration($doctrineConfig['source-folders'], $doctrineConfig['debug']);
        if ($doctrineConfig['proxy-dir']) {
            $config->setProxyDir($doctrineConfig['proxy-dir']);
        }
        $config->setAutoGenerateProxyClasses($doctrineConfig['auto-genarate-proxy']);
        if (null !== $this->cache) {
            $config->setMetadataCacheImpl($this->cache);
            $config->setQueryCacheImpl($this->cache);
            $config->setResultCacheImpl($this->cache);
            $config->setHydrationCacheImpl($this->cache);
        }
        $this->entityManager = EntityManager::create($doctrineConfig, $config);
    }

    /**
     * @return EntityManager
     */
    public function getEntityManager()
    {
        if (null === $this->entityManager) {
            $this->createEntityManager();
        }
        return $this->entityManager;
    }

    public function getTemplateEngine()
    {
        if (null === $this->templateEngine) {
            $this->createTemplateEngine();
        }
        return $this->templateEngine;
    }

    public function getSession()
    {
        if (null === $this->sessionManager) {
            $this->sessionManager = new SessionManager();
        }
        return $this->sessionManager;
    }

    private function initHandlers()
    {
        set_exception_handler(Array('\Faderim\Core\Handler', 'exceptionHandler'));
        set_error_handler(Array('\Faderim\Core\Handler', 'errorHandler'));
    }

    public function setLoader(ClassLoader $loader = null)
    {
        $this->loader = $loader;
    }

    public function getRootPath($file = null)
    {
        $path = dirname(dirname(dirname(__DIR__)));
        return ($file === null ? $path : $path . DIRECTORY_SEPARATOR . $file);
    }

    /**
     *
     * @return ClassLoader
     */
    public function getLoader()
    {
        return $this->loader;
    }

    public function getRouter()
    {
        return $this->router;
    }

    public function setRouter(\Faderim\Framework\Model\Router $router)
    {
        $this->router = $router;
    }

    public function getLogger($loggerName)
    {
        return \Faderim\Log\LogContainer::getLogger($loggerName);
    }

    /**
     * @return IRequest
     */
    public function getRequest()
    {
        return $this->request;
    }

    public function setRequest(IRequest $request)
    {
        $this->request = $request;
    }

    public function getCache()
    {
        return $this->cache;
    }

    public function setCache(\Doctrine\Common\Cache\Cache $cache)
    {
        $this->cache = $cache;
    }

}
