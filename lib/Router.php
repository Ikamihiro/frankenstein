<?php

namespace Lib;

use Lib\Http\Request;

class Router
{
    private $routes = [];
    public Request $request;
    private $params;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function add(string $method, string $route, $action)
    {
        $this->routes[$method][$route] = $action;
    }

    public function get(string $route, $action)
    {
        $this->add('get', $route, $action);
    }

    public function post(string $route, $action)
    {
        $this->add('post', $route, $action);
    }

    public function put(string $route, $action)
    {
        $this->add('put', $route, $action);
    }

    public function delete(string $route, $action)
    {
        $this->add('delete', $route, $action);
    }

    public function getParams()
    {
        return array_slice($this->params, 1);
    }

    public function getRoute()
    {
        $method = $this->request->getMethod();
        $url = $this->request->getUrl();

        if (isset($this->routes[$method][$url])) {
            return $this->routes[$method][$url];
        }

        foreach ($this->routes[$method] as $route => $action) {
            $result = $this->checkUrl($route, $url);

            if ($result >= 1) {
                return $action;
            }
        }

        return false;
    }

    private function checkUrl(string $route, $path)
    {
        preg_match_all('/\{([^\}]*)\}/', $route, $variables);
        $regex = str_replace('/', '\/', $route);

        foreach ($variables[0] as $k => $variable) {
            $replacement = '([a-zA-Z0-9\-\_\ ]+)';
            $regex = str_replace($variable, $replacement, $regex);
        }

        $result = preg_match('/^' . $regex . '$/', $path, $params);
        $regex = preg_replace('/{([a-zA-Z]+)}/', '([a-zA-Z0-9+])', $regex);

        $this->params = $params;

        return $result;
    }
}
