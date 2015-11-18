<?php

namespace Faderim\Ext\Field;

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of FormField
 *
 * @author Ricardo
 */
class GridField extends BaseField
{

    private $childProps = Array();
    private $filter;
    private $visible;

    //put your code here
    public function __construct($type, $name, $title = 'Field', $size = 1, $filter = false, $visible = true)
    {
        parent::__construct($type, $name, $title);
        $this->setSize($size);
        if ($type = $this->getTypeField()->getExtTypeColumn()) {
            $this->childProps['xtype'] = $type;
        }
        $this->filter = $filter;
        $this->visible = $visible;
    }

    public function setEditable()
    {
        $aProps = $this->getTypeField()->getCustomProperties();
        $aProps['xtype'] = $this->getType() . 'field';
        $this->childProps['field'] = $aProps;
    }

    public function setRenderer(\Faderim\Ext\EventListener $event)
    {
        $this->childProps['renderer'] = $event;
    }

    public function setSummaryType($sum)
    {
        $this->childProps['summaryType'] = $sum;
    }

    public function setSummaryRenderer($rem)
    {
        $this->childProps['summaryRenderer'] = $rem;
    }

    protected function setDefaultProperties()
    {

    }

    public function setSize($size)
    {
        if (is_int($size) and $size > 1) {
            $this->childProps['width'] = $size;
        } else {
            $this->childProps['flex'] = $size;
        }
    }

    public function getJsonFormat()
    {
        foreach ($this->getTypeField()->getCustomProperties() as $prop => $val) {
            $this->childProps[$prop] = $val;
        }
        $this->childProps['text'] = $this->getTitle();
        $this->childProps['dataIndex'] = $this->getName();
        $this->childProps['filter'] = $this->filter;
        $this->childProps['hidden'] = !$this->visible;
        return $this->childProps;
    }

    public function getFilter()
    {
        return $this->filter;
    }

    public function setFilter($filter)
    {
        $this->filter = $filter;
    }

    public function getVisible()
    {
        return $this->visible;
    }

    public function setVisible($visible)
    {
        $this->visible = $visible;
    }

}
