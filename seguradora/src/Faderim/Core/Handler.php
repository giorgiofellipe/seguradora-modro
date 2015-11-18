<?php

namespace Faderim\Core;

/**
 * Description of Handler
 *
 * @author Rick
 */
class Handler
{

    //put your code here

    public static function exceptionHandler(\Exception $Ex)
    {
        header('HTTP/1.1 500 Internal Server Error', true, 500);
        header('Faderim-Exception:' . substr(json_encode($Ex->getMessage()), 0, 5000));
        header('Faderim-Exception-Trace:' . json_encode($Ex->getTraceAsString()));
        echo $Ex->getMessage();
        echo $Ex->getTraceAsString();
    }

    public static function errorHandler($errno, $errstr, $errfile, $errline)
    {
        if ($errno == 0) {
            return;
        }
        throw new \ErrorException($errstr, $errno, 0, $errfile, $errline);
    }

}
