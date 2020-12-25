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

    public function redirect($routeName = null, $params = array()): void
    {
        if (!empty($params))
        {
            Session::init();
            foreach ($params as $key => $value)
            {
                Session::set($key, $value);
            }
        }

        if (!is_null($routeName))
        {
            header('Location: ' . URL . $routeName);
        } else {
            // Se não for especificada, redireciona para
            // a rota raiz do sistema
            header('Location:' . URL);
        }
    }

    public function view($view, array $params = array())
    {
        View::getInstance()->render($view, $params);
    }
}