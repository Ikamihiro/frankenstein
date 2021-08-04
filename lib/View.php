<?php

namespace Lib;

class View
{
    protected static View $instance;
    protected string $layout;

    public function __construct(string $layout)
    {
        $this->layout = $layout;
    }

    public static function getInstance($layout = 'default'): View
    {
        if (!isset(self::$instance)) {
            self::$instance = new self($layout);
        }

        return self::$instance;
    }

    public function render($view, array $params)
    {
        $layoutName = $this->layout;
        $viewContent = $this->renderViewOnly($view, $params);

        ob_start();
        include_once __DIR__ . "/../views/layouts/$layoutName.php";
        $layoutContent = ob_get_clean();

        return str_replace('{{content}}', $viewContent, $layoutContent);
    }

    public function renderViewOnly($view, array $params)
    {
        foreach ($params as $key => $value) {
            $$key = $value;
        }

        ob_start();
        include_once __DIR__ . "/../views/resources/$view.php";
        return ob_get_clean();
    }
}
