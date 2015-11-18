<?php

namespace Faderim\Util;

/**
 * Description of ConfigReader
 *
 * @author Ricardo Schroeder <ricardo@magamobi.com.br>
 */
abstract class ConfigReader
{

    private static $config = Array();
    private static $configExt = Array();

    public static function readConfig($configName)
    {
        $root = \Faderim\Core\FaderimEngine::getInstance()->getRootPath();
        $con = \Symfony\Component\Yaml\Yaml::parse(file_get_contents($root . '/config/' . $configName . '.yml'));
        return $con;
    }

    public static function readDefaultConfig($config)
    {
        $fileName = (isset(static::$config[$config])) ? static::$config[$config] : $config;
        $arrayConfig = self::readConfig($fileName);
        $fileNameExtended = (isset(static::$configExt[$config])) ? static::$configExt[$config] : $config . '-default';
        if ($fileNameExtended) {
            $arrayConfigExtended = self::readConfig($fileNameExtended);
            return array_replace_recursive($arrayConfigExtended, $arrayConfig);
        } else {
            return $arrayConfig;
        }
    }

    public static function setConfigName($app, $file, $fileExtended)
    {
        self::$config[$app] = $file;
        self::$configExt[$app] = $fileExtended;
    }

}
