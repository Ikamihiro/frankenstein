<?php

namespace App\Lib\Http;

use App\Lib\Utils\Auth;

class Controller
{
    public $request;

    public function __construct()
    {
        $this->request = new Request();
    }

    public function redirect($routeName = null, array $params = array()): void
    {
        ob_start();

        if (!is_null($routeName))
        {
            if (!is_null($params))
            {
                Session::init();
                foreach ($params as $key => $value)
                {
                    Session::set($key, $value);
                }
            }

            header('Location: ' . URL_BASE . $routeName);
        } else {
            // Se não for especificada, redireciona para
            // a rota raiz do sistema
            header('Location:' . URL_BASE);
        }

        ob_flush();
    }

    public function view($view, array $params = array())
    {
        View::getInstance()->render($view, $params);
    }

    public function lock()
    {
        Auth::getInstance()->lock();
    }

    public function onlyGuest()
    {
        Auth::getInstance()->onlyGuest();
    }

    public function authorize($role)
    {
        Auth::getInstance()->authorize($role);
    }

    public function logoutUser()
    {
        Auth::getInstance()->logout();
    }
}