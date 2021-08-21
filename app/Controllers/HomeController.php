<?php

namespace App\Controllers;

use Frankenstein\Http\Controller;
use Frankenstein\Http\Request;
use Frankenstein\Http\Response;

class HomeController extends Controller
{
    public function index(Request $request, Response $response)
    {
        return $response->json([
            'data' => 'Hello World!',
        ]);
    }
}
