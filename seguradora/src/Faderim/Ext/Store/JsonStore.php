<?php

namespace Faderim\Ext\Store;

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class JsonStore extends BaseStore
{

    private $url;
    private $autoLoad = true;

    public function setUrl($url)
    {
        $this->url = $url;
    }

    public function getAutoLoad()
    {
        return $this->autoLoad;
    }

    public function setAutoLoad($autoLoad)
    {
        $this->autoLoad = $autoLoad;
    }

    protected function getExtProperties()
    {
        $aProp = parent::getExtProperties();
        $aProp['autoLoad'] = $this->autoLoad;
        $aProp['proxy'] = Array('type' => 'ajax', 'url' => $this->url, 'reader' => Array('filterParam' => 'query', 'type' => 'json', 'root' => 'rows', 'totalProperty' => 'total'));
        return $aProp;
    }

    public function getTypeStore()
    {
        return 'Json';
    }

}
