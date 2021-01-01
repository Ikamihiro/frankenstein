<?php

namespace App\Controllers;

use App\Lib\Http\Controller;
use App\Lib\Http\View;
use App\Models\User;

class HomeController extends Controller
{
    public function index()
    {
        try {
            $this->view('home');
        } catch (\Exception $e) {
            $this->view('home', [
                'erro' => $e->getMessage(),
            ]);
        }
    }

    public function about()
    {
        $user = new User();
        try {
            $user->save();
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }
}