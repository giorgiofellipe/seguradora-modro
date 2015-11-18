<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Faderim\Ext;

/**
 * Description of Base
 *
 * @author ricardo
 */
class Base implements \Faderim\Json\JsonSerializable
{

    protected $properties = null;
    protected $extended = null;
    protected $extendedFile = null;

    public function create()
    {
        $this->onCreate();
        $sParams = \Faderim\Json\Json::encode($this->getExtProperties());
        if ($this->extended !== null) {
            $sResponse = 'Ext.create(' . json_encode($this->getExtClassName()) . ',Ext.merge(' . $sParams . ',' . $this->extended . '))';
        } else {
            $sResponse = 'Ext.create(' . json_encode($this->getExtClassName()) . ',' . $sParams . ')';
        }
        return $sResponse;
    }

    public function setExtendedFromJs($file)
    {
        $this->extendedFile = $file;
    }

    public function setExtended($ext)
    {
        $this->extended = $ext;
    }

    public function getJsonFormat()
    {
        return $this->create();
    }

    protected function getExtClassName()
    {
        return 'Ext.' . get_class($this);
    }

    protected function getExtProperties()
    {
        return $this->properties;
    }

    protected function onCreate()
    {
        if ($this->extendedFile !== null) {
            $this->extended = file_get_contents(\Faderim\File\FileUtils::findDirNamespace($this->extendedFile) . '.js');
        }
    }

    public function __toString()
    {
        return $this->create();
    }

}
