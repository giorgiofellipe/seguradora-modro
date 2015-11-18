<?php

namespace Faderim\Core;

/**
 * @author ricardo
 */
interface IRequest
{

    public function hasParameter($paramName);

    public function getParameter($paramName, $defaultValue = null);
}
