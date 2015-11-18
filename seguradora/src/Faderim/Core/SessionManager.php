<?php

namespace Faderim\Core;

/**
 * Objeto Manipulador da Sessão
 *
 * @author Ricardo Schroeder
 */
class SessionManager
{

    /**
     * Variaveis da sessão que serão mantidas somente durante a requisição
     * @var array
     */
    private $request = Array();

    public function __construct()
    {
        $this->init();
    }

    public function init()
    {
        session_start();
    }

    public function get($key)
    {
        return $_SESSION[$key];
    }

    public function has($key)
    {
        return array_key_exists($key, $_SESSION);
    }

    public function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    public function setRequest($key, $value)
    {
        $this->request[$key] = $value;
    }

    public function getRequest($key)
    {
        return $this->request[$key];
    }

    public function hasRequest($key)
    {
        return array_key_exists($key, $this->request);
    }

    public function destroy()
    {
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000, $params["path"], $params["domain"], $params["secure"], $params["httponly"]
            );
        }
        session_destroy();
    }

    public function writeClose()
    {
        \session_write_close();
    }

}
