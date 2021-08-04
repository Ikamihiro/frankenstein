<?php

namespace App\Controllers;

use Lib\Controller;
use Lib\Http\{Request, Response};

class HomeController extends Controller
{
    public function index(Request $request, Response $response)
    {
        return $this->view('home', []);
    }

    public function hello(Request $request, Response $response, string $name)
    {
        return $response->json("Olá {$name}");
    }
}
