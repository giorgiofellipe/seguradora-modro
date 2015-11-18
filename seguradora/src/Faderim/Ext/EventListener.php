<?php

namespace Faderim\Ext;

use Faderim\Json\Json;

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TreeNode
 *
 * @author Ricardo
 */
class EventListener implements \Faderim\Json\JsonSerializable
{

    private $functionName;
    private $params;

    public function __construct($functionName, $args = Array())
    {
        $this->functionName = $functionName;
        $this->params = $args;
    }

    private function getParamsAsJsArgs()
    {
        $aParams = Array();
        foreach ($this->params as $argAtual) {
            if ($argAtual instanceof Component) {
                $aParams[] = 'Ext.getCmp(' . Json::encode($argAtual->getName()) . ')';
            } else {
                $aParams[] = Json::encode($argAtual);
            }
        }
        $this->params = '[' . implode(',', $aParams) . ']';
    }

    public function getJsonFormat()
    {
        if (count($this->params)) {
            $sParms = $this->getParamsAsJsArgs();
            return "function() { return " . $this->functionName . ".apply(this," . $sParms . ");}";
        } else {
            return $this->functionName;
        }
    }

}

