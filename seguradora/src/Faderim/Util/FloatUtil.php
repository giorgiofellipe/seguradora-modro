<?php

namespace Faderim\Util;

/**
 * Description of FloatUtil
 *
 * @author ricardo
 */
abstract class FloatUtil
{

    public static function strToFloat($str, $decimal = ',', $milhar = '.')
    {
        $str = str_replace($milhar, '', $str);
        $str = str_replace($decimal, '.', $str);
        return (float) $str;
    }

}
