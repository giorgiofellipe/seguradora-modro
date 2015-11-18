<?php

namespace Faderim\Util;

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DateUtil
 *
 * @author Ricardo Schroeder
 */
abstract class DateUtil
{

    CONST FORMAT_US = 'Y-m-d';

    public static function currentDate($format = self::FORMAT_US)
    {
        return date($format);
    }

    public static function currentDateTime($format = 'Y-m-d H:i:s')
    {
        return date($format);
    }

}
