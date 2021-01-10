<?php

namespace App\Controllers\Auth;

use App\Lib\Http\Controller;
use App\Models\User;
use Exception;

class UserController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->auth->lock();
    }

    public function index()
    {
        try {
            $users = User::factory()->all();
            $this->view('admin/users/index', [
                'users' => $users,
            ]);
        } catch (Exception $e) {
            $this->view('admin/users/index', [
                'erro' => $e->getMessage(),
            ]);
        }
    }

    public function create()
    {
        $this->view('admin/users/create');
    }

    public function store()
    {

    }

    public function edit($id)
    {
        $this->view('admin/users/edit');
    }

    public function update($id)
    {

    }

    public function delete($id)
    {

    }
}