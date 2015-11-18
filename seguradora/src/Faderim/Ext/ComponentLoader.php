<?php

namespace Faderim\Ext;

/**
 * Description of ComponentLoader
 *
 * @author Ricardo
 */
class ComponentLoader implements \Faderim\Json\JsonSerializable {

    public function getExtClassName() {
        return 'Ext.ComponentLoader';
    }

    public function setAutoLoad($xPropValue, $sUrl) {
        /*
          $this->setProperty('autoLoad', (bool) $xPropValue);
          $this->setProperty('url', $sUrl);
          $this->setProperty('renderer', 'component');
         * 
         */
    }

    public function getJsonFormat() {
        return Array(
            "url" => '?p=index&a=data&pr=getDataMenu',
            "renderer" => "component",
            "autoLoad" => true
        );
    }

}
