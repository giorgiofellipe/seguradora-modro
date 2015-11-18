<?php

namespace Faderim\File;

/**
 * Description of FileUtils
 *
 * @author ricardo
 */
class FileUtils
{

    public static function findDirNamespace($sNamespace)
    {
        $autoloader = \Faderim\Core\FaderimEngine::getInstance()->getLoader();
        //verifica se o template ta dentro de uma pasta com autoload
        $sPath = null;
        foreach ($autoloader->getPrefixes() as $sNamespaceAL => $aFind) {
            if (0 === strpos($sNamespace, $sNamespaceAL)) {
                $iLength = strlen($sNamespaceAL);
                $sPath = $aFind[0] . substr($sNamespace, $iLength);
            }
        }
        if (is_null($sPath)) {
            foreach ($autoloader->getFallbackDirs() as $sFallbackDir) {
                $sNewDir = $sFallbackDir . '/' . $sNamespace;
                $sNewDir = str_replace('\\', '/', $sNewDir);
                return $sNewDir;
            }
        }
        return $sPath;
    }

    /**
     * Deleta um diretório recursivamente, incluindo todos seus arquivos
     * @param type $path
     */
    public static function delDirRecursive($path)
    {
        if (!is_dir($path)) {
            throw new \Exception('Path ' . $path . ' não é um diretório válido!');
        }
        $files = scandir($path);
        foreach ($files as $file) {
            if ($file !== '.' and $file !== '..') {
                $currentPath = $path . DIRECTORY_SEPARATOR . $file;
                if (is_dir($currentPath)) {
                    static::delDirRecursive($currentPath);
                } else {
                    unlink($currentPath);
                }
            }
        }
        return rmdir($path);
    }

}
