<?php

namespace Faderim\Twig;

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Loader
 *
 * @author Ricardo Schroeder
 */
class Loader implements \Twig_LoaderInterface
{

    public function getCacheKey($name)
    {
        return $name;
    }

    public function getSource($name)
    {
        $sFileName = $this->getFileTemplate($name);
        return file_get_contents($sFileName);
    }

    public function isFresh($name, $time)
    {
        die('Cache not Enable');
    }

    private function getFileTemplate($sTemplateName)
    {
        return \Faderim\File\FileUtils::findDirNamespace($sTemplateName) . '.html.twig';
    }

}
