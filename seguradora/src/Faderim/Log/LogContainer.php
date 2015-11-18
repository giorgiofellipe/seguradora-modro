<?php

namespace Faderim\Log;

/**
 * @author Ricardo Schroeder <ricardo.schroeder.bsi@gmail.com>
 */
class LogContainer
{

    /**
     *
     * @var \Monolog\Logger
     */
    private static $container = Array();
    private static $handlerAll = Array();
    private static $handler = Array();

    /**
     *
     * @param type $loggerName
     * @return \Monolog\Logger
     */
    public static function getLogger($loggerName = 'global')
    {
        if (!isset(self::$container[$loggerName])) {
            $logger = new \Monolog\Logger($loggerName, self::$handlerAll);
            self::$container[$loggerName] = $logger;
        }
        return self::$container[$loggerName];
    }

    /**
     * Adiciona um handler para todos os logs
     * @param \Monolog\Handler\HandlerInterface $handler
     */
    public static function addHandlerAll(\Monolog\Handler\HandlerInterface $handler)
    {
        return;
        self::$handlerAll[] = $handler;
        //pega todos os handlers ja existentes e adiciona também
        foreach (self::$container as $logger) {
            $logger->pushHandler($handler);
        }
    }

    /**
     *
     * @param \Monolog\Handler\HandlerInterface $handler
     * @param type $loggerName
     * @todo fazer com que os handlers sejam adicionados
     */
    public static function addHandler(\Monolog\Handler\HandlerInterface $handler, $loggerName = 'global')
    {
        return;
        if (!isset(self::$handler[$loggerName])) {
            self::$handler[$loggerName] = Array();
        }
        self::$handler[$loggerName][] = $handler;
    }

}
