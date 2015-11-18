<?php

namespace Faderim\Json;

/**
 * Description of JsonResponse
 *
 * @author ricardo
 */
class JsonResponse implements \Faderim\Json\JsonSerializable
{

    private $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function getJsonFormat()
    {
        return json_encode($this->data);
    }

}
