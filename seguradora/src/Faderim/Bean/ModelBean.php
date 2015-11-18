<?php

namespace Faderim\Bean;

class ModelBean
{

    public static function getModelProperty($currentModel, $sProp)
    {
        $value = \Faderim\Core\FaderimReflectionClass::callGetter($currentModel, $sProp);
        /* if ($value instanceof \DateTime) {
          //$value = $value->format('Y-m-d H:i:s');
          $value = $value->format('d/m/Y');
          } */
        return $value;
    }

}
