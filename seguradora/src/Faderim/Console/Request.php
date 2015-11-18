<?php

namespace Faderim\Console;

/**
 * Description of Request
 *
 * @author ricardo
 */
class Request implements \Faderim\Core\IRequest
{

    private $param = Array();

    public function addParameter($paramName, $paramValue)
    {
        $this->param[$paramName] = $paramValue;
    }

    public function getParameter($paramName, $defaultValue = null)
    {
        if ($this->hasParameter($paramName)) {
            return $this->param[$paramName];
        } else {
            return $defaultValue;
        }
    }

    public function hasParameter($paramName)
    {
        return array_key_exists($paramName, $this->param);
    }

}
