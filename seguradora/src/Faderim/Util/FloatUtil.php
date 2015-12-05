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

    public static function anyStrToFloat($str, $decimal = ',', $milhar = '.')
    {
        $str = preg_replace("/[^0-9\\" . $decimal . "\\" . $milhar . "]/", "", $str);
        $str = str_replace($milhar, '', $str);
        $str = str_replace($decimal, '.', $str);
        return (float) $str;
    }

    public static function floatToStr($float, $decimais = 2, $milhar = '.', $decimal = ',')
    {
        return number_format($float, $decimais, $decimal, $milhar);
    }

    public static function regraDeTres($valor1, $valorEquiv1, $valor2)
    {
        return ($valor2 * $valorEquiv1) / $valor1;
    }

}
