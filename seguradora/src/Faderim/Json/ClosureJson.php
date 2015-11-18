<?php

namespace Faderim\Json;

/**
 * Customize the send format of json
 */
class ClosureJson implements \Faderim\Json\JsonSerializable
{

    private $clouse;

    public function __construct(\Closure $c)
    {
        $this->clouse = $c;
    }

    public function getJsonFormat()
    {
        return call_user_func($this->clouse);
    }

}
