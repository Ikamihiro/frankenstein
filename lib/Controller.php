<?php

namespace Lib;

class Controller
{
    protected View $view;

    public function __construct()
    {
        $this->view = View::getInstance();
    }

    public function view($view, array $params)
    {
        return $this->view->render($view, $params);
    }
}
