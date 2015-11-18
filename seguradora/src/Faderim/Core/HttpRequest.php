<?php

namespace Faderim\Core;

/**
 *
 * @author Ricardo Schroeder
 */
class HttpRequest implements IRequest
{

    /**
     *
     * @param type $filename nome do arquivo
     * @return \Faderim\Core\FileUpload[]
     */
    public function getFile($filename, $multiple = false)
    {
        if (isset($_FILES[$filename])) {
            $file = $_FILES[$filename];
            if ($multiple === true) {
                $files = Array();
                foreach ($file['name'] as $key => $val) {
                    if ($file['size'] > 0) {
                        $files[] = new FileUpload($file['name'][$key], $file['type'][$key], $file['tmp_name'][$key], $file['error'][$key]);
                    }
                }
                return $files;
            } else if ($file['size'] > 0) {
                return new FileUpload($file['name'], $file['type'], $file['tmp_name'], $file['error']);
            } else {
                return null;
            }
        }
    }

    public function getParameter($paramName, $defaultValue = null)
    {
        return $this->hasParameter($paramName) ? (get_magic_quotes_gpc() ? \stripslashes($_REQUEST[$paramName]) : $_REQUEST[$paramName]) : $defaultValue;
    }

    public function getJsonParameter($paramName, $defaultValue = null)
    {
        return $this->hasParameter($paramName) ? json_decode($this->getParameter($paramName), true) : $defaultValue;
    }

    public function hasParameter($paramName)
    {
        return array_key_exists($paramName, $_REQUEST);
    }

    public function getPath()
    {
        if (isset($_SERVER['PATH_INFO'])) {
            return $_SERVER['PATH_INFO'];
        }
        if (isset($_SERVER['ORIG_PATH_INFO'])) {
            return $_SERVER['ORIG_PATH_INFO'];
        }
        return '/';
    }

    public function isAjax()
    {
        return (isset($_SERVER['HTTP_X_REQUESTED_WITH']) and 'XMLHttpRequest' == $_SERVER['HTTP_X_REQUESTED_WITH']) ?
                true : false;
    }

    public function isPost()
    {
        return $this->isMethod('POST');
    }

    public function isGet()
    {
        return $this->isMethod('GET');
    }

    public function isMethod($methodName)
    {
        return $methodName == $_SERVER['REQUEST_METHOD'];
    }

    public function isDelete()
    {
        return $this->isMethod('DELETE');
    }

    public function getInputData()
    {
        return file_get_contents("php://input");
    }

    public function getValues()
    {
        $values = Array();
        $keys = array_keys($_REQUEST);
        foreach ($keys as $keyName) {
            $values[$keyName] = $this->getParameter($keyName);
        }
        return $values;
    }

}
