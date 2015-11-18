<?php

namespace Faderim\Core;

use Faderim\Json\Json;

/**
 * Description of JsonResponse
 *
 * @author Ricardo Schroeder
 */
class JsonResponse implements IBaseView
{

    private $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function render()
    {
        return Json::encode($this->data);
    }

    protected function setData($data)
    {
        $this->data = $data;
    }

}
