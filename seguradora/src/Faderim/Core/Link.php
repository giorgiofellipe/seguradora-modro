<?php

namespace Faderim\Core;

class Link
{

    private $routerName;
    private $action;

    function __construct($routerName, $action = null)
    {
        $this->routerName = $routerName;
        $this->action = $action;
    }

    public function getUrl()
    {
        $url = '?router=' . $this->routerName;
        if ($this->action !== null) {
            $url .= '&action=' . $this->action;
        }
        return $url;
    }

}

