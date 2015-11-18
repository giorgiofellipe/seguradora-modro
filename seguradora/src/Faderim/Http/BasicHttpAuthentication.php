<?php

namespace Faderim\Http;

/**
 * Classe utilizada para realização de autenticação HTTP
 *
 * @author ricardo
 */
class BasicHttpAuthentication
{

    private $message = 'Enter your credentials';
    private $validUsers = Array();

    /**
     *
     * @var \Closure
     */
    private $functionValidUser;

    public function setMessage($message)
    {
        $this->message = $message;
    }

    public function addValidUser($user, $pass)
    {
        $this->validUsers[$user] = $pass;
    }

    private function requestAuth()
    {
        header('WWW-Authenticate: Basic realm="' . $this->message . '"');
        header('HTTP/1.0 401 Unauthorized');
        echo 'Unauthorized!';
        exit;
    }

    public function setFunctionValidUser(\Closure $fn)
    {
        $this->functionValidUser = $fn;
    }

    protected function validateUser($user, $pass)
    {
        $valid = false;
        if (isset($this->functionValidUser)) {
            $valid = call_user_func($this->functionValidUser, $user, $pass);
        } elseif (isset($this->validUsers[$user]) and $this->validUsers[$user] == $pass) {
            $valid = true;
        }
        return $valid;
    }

    public function isValidUser($user, $pass)
    {
        return $this->validateUser($user, $pass);
    }

    public function auth()
    {
        if (!isset($_SERVER['PHP_AUTH_USER'])) {
            $this->requestAuth();
        } else if (isset($_SERVER['PHP_AUTH_USER']) and isset($_SERVER['PHP_AUTH_PW'])) {
            $user = $_SERVER['PHP_AUTH_USER'];
            $pass = $_SERVER['PHP_AUTH_PW'];
            $valid = $this->validateUser($user, $pass);
            if (!$valid) {
                $this->requestAuth();
            } else {
                return true;
            }
        } else {
            $this->requestAuth();
        }
    }

}
