<?php

namespace App\Lib\Http;

use App\Lib\Utils\Auth;

class Controller
{
    public $request;
    public $auth;

    public function __construct()
    {
        $this->request = new Request();
        $this->auth = Auth::getInstance();
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
}