<?php

namespace Faderim\Ext;

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TreeNode
 *
 * @author Ricardo
 */
class Listener implements \Faderim\Json\JsonSerializable {

    private $event = Array();

    protected function addListener($sType, $sFunctionName) {
        if(!isset($this->event[$sType])) {
            //$this->event[$sType] = Array();
        }
        $this->event[$sType] = new EventListener($sFunctionName);
    }

    public function onClick($sFunction) {
        $this->addListener('click', $sFunction);
    }

    public function onDoubleClick($sFunction) {
        $this->addListener('select', $sFunction);
    }

    public function onItemClick($sFunction) {
        $this->addListener('itemclick', $sFunction);
    }

    public function getJsonFormat() {
        return $this->event;
    }
}