<?php

namespace App\Controllers\Auth;

use App\Lib\Http\Controller;
use App\Lib\Utils\Auth;

class LoginController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->onlyGuest();
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

            $result = Auth::getInstance()->login($email, $senha);

            if ($result) {
                $this->redirect();
            } else {
                $this->redirect('login', ['erro' => 'Suas credenciais estão erradas']);
            }
        } catch (\Exception $e) {
            $this->redirect('login', ['erro' => $e->getMessage()]);
        }
    }

    public function logout()
    {
        try {
            $this->logoutUser();
            $this->redirect();
        } catch (\Exception $e) {
            $this->redirect('login', ['erro' => $e->getMessage()]);
        }
    }
}