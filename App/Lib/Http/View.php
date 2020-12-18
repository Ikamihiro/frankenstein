<?php

namespace App\Lib\Http;

class View
{
    private static $singleton;
    private $defaultLayout;

    public function __construct($layout = 'default')
    {
        $this->defaultLayout = $layout;
    }

    public static function getInstance(): View
    {
        if (self::$singleton == null)
        {
            self::$singleton = new View();
        }

        return self::$singleton;
    }

    public function render($view, $params = array())
    {
        $viewContent = $this->renderViewOnly($view, $params);

        ob_start();
        include_once ROOT . "/views/layouts/$this->defaultLayout.php";
        $layoutContent = ob_get_clean();

        echo str_replace('{{content}}', $viewContent, $layoutContent);
    }

    public function renderViewOnly($view, $params = array())
    {
        foreach ($params as $key => $value)
        {
            $$key = $value;
        }

        ob_start();
        include_once ROOT . "/views/$view.php";
        return ob_get_clean();
    }

    public function setLayout($newLayout)
    {
        $this->defaultLayout = $newLayout;
    }
}