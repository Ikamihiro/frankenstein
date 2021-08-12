<?php

namespace App\Controllers;

use App\Models\User;
use Lib\Controller;
use Lib\Http\{Request, Response};

class UsersController extends Controller
{
    public function index(Request $request, Response $response)
    {
        $users = User::all();

        return $this->view('users', [
            'users' => $users,
        ]);
    }
}
