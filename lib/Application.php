<?php

namespace Lib;

class Application
{
    public Request $request;
    public Router $router;
    public Response $response;
    public ?Controller $controller;

    public function __construct()
    {
        $this->request = new Request();
        $this->response = new Response();
        $this->router = new Router($this->request);
    }

    public function run()
    {
        try {
            $callback = $this->router->getRoute();

            if (!$callback) {
                echo $this->response->json('Not found', 404);
                die();
            }

            if (is_array($callback)) {
                $controller = new $callback[0];
                $controller->action = $callback[1];
                $this->controller = $controller;
                $callback[0] = $controller;
            }

            echo call_user_func($callback, $this->request, $this->response, ...$this->router->getParams());
        } catch (\Throwable $th) {
            echo $this->response->json($th->getMessage(), 404);
            die();
        }
    }
}
