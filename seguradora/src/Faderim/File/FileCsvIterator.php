<?php

namespace Faderim\File;

/**
 * Description of FileCsvIterator
 *
 * @author ricardo
 */
class FileCsvIterator extends FileRowIterator
{

    private $forceEncoding = 'UTF-8';
    private $separator = ';';

    protected function getLine()
    {
        $linha = parent::getLine();
        if ($linha === false) {
            return false;
        }
        if ($this->forceEncoding !== null and ! mb_check_encoding($linha, $this->forceEncoding)) {
            $linha = mb_convert_encoding($linha, $this->forceEncoding);
        }
        $linha = str_getcsv($linha, $this->separator, null);
        return $linha;
    }

    public function setForceEncoding($encoding)
    {
        $this->forceEncoding = $encoding;
    }

}
