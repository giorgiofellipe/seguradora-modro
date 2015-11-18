<?php

namespace Faderim\Core;

/**
 * Description of FileUpload
 *
 * @author Ricardo Schroeder
 */
class FileUpload
{

    CONST MIME_TEXT = 'text/plain';

    private $name;
    private $type;
    private $path;

    public function __construct($name, $type, $tmp_name, $status)
    {

        $this->name = $name;
        $this->type = $type;
        $this->path = $tmp_name;
        if (UPLOAD_ERR_OK != $status) {
            switch ($status) {
                case UPLOAD_ERR_FORM_SIZE:
                case UPLOAD_ERR_INI_SIZE:
                    throw new \Exception('The uploaded file exceeds the upload_max_filesize');
                case UPLOAD_ERR_PARTIAL:
                    throw new \Exception('The uploaded file was only partially uploaded.');
                case UPLOAD_ERR_NO_FILE:
                default:
                    throw new \Exception('No file was uploaded');
            }
        }
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getType()
    {
        return $this->type;
    }

    public function setType($type)
    {
        $this->type = $type;
    }

    public function moveTo($path, $fileName = null, $checkdir = true)
    {
        if (is_null($fileName)) {
            $fileName = $this->getName();
        }
        if ($checkdir and ! is_dir($path)) {
            mkdir($path, 0777, true);
        }
        return move_uploaded_file($this->path, $path . DIRECTORY_SEPARATOR . $fileName);
    }

    public function getPath()
    {
        return $this->path;
    }

    public function getStream()
    {
        return fopen($this->getPath(), 'r+');
    }

    public function getContents()
    {
        return file_get_contents($this->getPath());
    }

    public function setPath($path)
    {
        $this->path = $path;
    }

    public static function getUploadPath()
    {
        return FaderimEngine::getInstance()->getRootPath() . DIRECTORY_SEPARATOR . 'upload';
    }

}
