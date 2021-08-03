<?php

namespace App\Controllers;

use Lib\Controller;
use Lib\Http\{Request, Response};

class AddressController extends Controller
{
    public function index(Request $request, Response $response)
    {
        return $response->json('Index');
    }

    public function create(Request $request, Response $response)
    {
        return $response->json("Create");
    }

    public function update(Request $request, Response $response, int $id)
    {
        return $response->json("Update");
    }

    public function delete(Request $request, Response $response, int $id)
    {
        return $response->json("Delete");
    }
}
