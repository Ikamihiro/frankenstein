<?php

namespace App\Controllers;

use App\Lib\Http\Controller;
use App\Lib\Http\View;

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
        $this->lock();
        $this->view('home');
    }
}