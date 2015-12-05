<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Faderim\Util;

/**
 * Description of StringUtil
 *
 * @author Rodrigo
 */
class StringUtil
{

    static public function slugify($text)
    {
        $text = self::removeAcentuacao($text);
        // replace non letter or digits by -
        $text = preg_replace('~[^\\pL\d]+~u', '-', $text);
        // trim
        $text = trim($text, '-');
        // transliterate
        if (function_exists('iconv')) {
            $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
        }
        // lowercase
        $text = strtolower($text);
        // remove unwanted characters
        $text = preg_replace('~[^-\w]+~', '', $text);
        return $text;
    }

    static public function soNumero($str)
    {
        return preg_replace("/[^0-9]/", "", $str);
    }

    static public function soAlfanumerico($str)
    {
        return preg_replace("/[^a-zA-Z0-9 ]+/", "", $str);
    }

    static public function stripHtmlFull($html)
    {
        return html_entity_decode(strip_tags($html), ENT_COMPAT, 'UTF-8');
    }

    static public function removeAcentuacao($string)
    {
        return strtr($string, array(
            'À' => 'A', 'Á' => 'A', 'Â' => 'A', 'Ã' => 'A', 'Ä' => 'A', 'Å' => 'A',
            'Æ' => 'A', 'Ç' => 'C', 'È' => 'E', 'É' => 'E', 'Ê' => 'E', 'Ë' => 'E',
            'Ì' => 'I', 'Í' => 'I', 'Î' => 'I', 'Ï' => 'I', 'Ð' => 'D', 'Ñ' => 'N',
            'Ò' => 'O', 'Ó' => 'O', 'Ô' => 'O', 'Õ' => 'O', 'Ö' => 'O', 'Ø' => 'O',
            'Ù' => 'U', 'Ú' => 'U', 'Û' => 'U', 'Ü' => 'U', 'Ý' => 'Y', 'Ŕ' => 'R',
            'Þ' => 's', 'ß' => 'B', 'à' => 'a', 'á' => 'a', 'â' => 'a', 'ã' => 'a',
            'ä' => 'a', 'å' => 'a', 'æ' => 'a', 'ç' => 'c', 'è' => 'e', 'é' => 'e',
            'ê' => 'e', 'ë' => 'e', 'ì' => 'i', 'í' => 'i', 'î' => 'i', 'ï' => 'i',
            'ð' => 'o', 'ñ' => 'n', 'ò' => 'o', 'ó' => 'o', 'ô' => 'o', 'õ' => 'o',
            'ö' => 'o', 'ø' => 'o', 'ù' => 'u', 'ú' => 'u', 'û' => 'u', 'ý' => 'y',
            'þ' => 'b', 'ÿ' => 'y', 'ŕ' => 'r')
        );
    }

    static public function stringToTs($palavra, $small = 0, $caracteresEspeciais = ' ')
    {
        //retirar caracteres indesejados da query que possam ser identificados como operadores lógicos na tsquery
        $palavra = trim(preg_replace('~[^\\pL\d]+~u', $caracteresEspeciais, $palavra));
        $queryE = "";
        $palavras = split(" ", $palavra);
        foreach ($palavras as $indice => $termo) {
            if (strlen($termo) <= $small) {
                $palavraE = "(" . $termo . "|" . $termo . ":*)";
            } else {
                $palavraE = $termo;
            }
            if (isset($palavras[$indice + 1])) {
                $palavraE .= " & ";
            }
            $queryE .= $palavraE;
        }
        return $queryE;
    }
    
    static public function stringToLikeAny($palavra)
    {
        $palavra = trim(preg_replace('~[^\\pL\d]+~u', ' ', $palavra));
        $palavra = str_replace(' ','_',$palavra);
        return '%'.$palavra.'%';
    }

}
