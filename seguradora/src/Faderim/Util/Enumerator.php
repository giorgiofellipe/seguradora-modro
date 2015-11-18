<?php

namespace Faderim\Util;

/**
 * Description of Enumerator
 *
 * @author Ricardo Schroeder
 */
class Enumerator
{

    private $list;

    public function __construct(Array $list)
    {
        $this->list = $list;
    }

    public function getList()
    {
        return $this->list;
    }

    public function isValidValue($val)
    {
        return array_key_exists($val, $this->list);
    }

    public function getDescription($val)
    {
        if ($this->isValidValue($val)) {
            return $this->list[$val];
        }
        return null;
    }

}

