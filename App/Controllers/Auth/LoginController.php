<?php

namespace App\Controllers\Auth;

use App\Lib\Http\Controller;

class LoginController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->view('auth/login');
    }

    public function login()
    {
        try {
            $email = $this->request->input('email');
            $senha = $this->request->input('password');

            $result = $this->auth->login($email, $senha);

            if ($result) {
                $this->redirect();
            } else {
                $this->view('auth/login', ['erro' => 'Suas credenciais estão erradas']);
            }
        } catch (\Exception $e) {
            $this->view('auth/login', ['erro' => $e->getMessage()]);
        }
    }

    public function logout()
    {
        try {
            $this->auth->logout();
            $this->redirect();
        } catch (\Exception $e) {
            $this->redirect('login', ['erro' => $e->getMessage()]);
        }
    }
}