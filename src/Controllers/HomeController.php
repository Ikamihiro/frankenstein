<?php

namespace App\Controllers;

use Lib\Controller;
use Lib\Request;
use Lib\Response;

class HomeController extends Controller
{
    public function index(Request $request, Response $response)
    {
        return $response->json('Hello Word');
    }

    public function hello(Request $request, Response $response, string $name)
    {
        return $response->json("Olá {$name}");
    }
}
