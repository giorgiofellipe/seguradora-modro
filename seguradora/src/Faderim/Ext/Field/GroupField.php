<?php

namespace Faderim\Ext\Field;

/**
 * Description of GroupField
 *
 * @author Ricardo Schroeder
 */
class GroupField extends \Faderim\Ext\Container
{

    protected $itemsProp = "columns";

    public function __construct($header)
    {
        parent::__construct(null);
        $this->setProperty('header', $header);
    }

    public function create()
    {
        return \Faderim\Json\Json::encode($this->getExtProperties());
    }

}
