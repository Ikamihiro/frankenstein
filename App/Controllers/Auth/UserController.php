<?php

namespace App\Controllers\Auth;

use App\Lib\Http\Controller;

class UserController extends Controller
{
    public function index()
    {
        $this->view('register');
    }

    public function register()
    {

    }
}