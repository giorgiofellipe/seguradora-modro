<?php

namespace Faderim\Ext;

/**
 * Description of Composite
 *
 * @author Ricardo
 */
class Component extends Base
{

    protected $properties = Array();
    protected $parent;

    public function __construct($name = null)
    {
        if (!is_null($name)) {
            $this->setName($name);
        }
        $this->setDefaultProperties();
    }

    protected function setDefaultProperties()
    {

    }

    public function setName($name)
    {
        $this->setProperty('name', $name);
        //$this->setProperty('id', $name);
    }

    public function setHidden($hide = true)
    {
        $this->setProperty('hidden', $hide);
    }

    public function getName()
    {
        return $this->getProperty('name');
    }

    public function setTitle($title)
    {
        $this->setProperty('title', $title);
    }

    public function setMargins($top = 0, $right = 0, $bottom = 0, $left = 0)
    {
        $this->setProperty('margins', implode(' ', func_get_args()));
    }

    public function setWidth($width)
    {
        $this->setProperty('width', $width);
    }

    public function setLabelWidth($width)
    {
        $this->setProperty('labelWidth', $width);
    }

    public function setHeight($height)
    {
        $this->setProperty('height', $height);
    }

    public function setProperty($sPropName, $xPropValue)
    {
        $this->properties[$sPropName] = $xPropValue;
    }

    public function getProperty($sPropName)
    {
        if (array_key_exists($sPropName, $this->properties)) {
            return $this->properties[$sPropName];
        } else {
            return null;
        }
    }

    /**
     *
     * @return Listener
     */
    public function getListener()
    {
        if ($list = $this->getProperty('listeners')) {
            return $list;
        } else {
            $list = new Listener($this);
            $this->setProperty('listeners', $list);
            return $list;
        }
    }

    public function getParent()
    {
        return $this->parent;
    }

    public function setParent($parent)
    {
        $this->parent = $parent;
    }

}
