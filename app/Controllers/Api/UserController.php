<?php

namespace App\Controllers\Api;

use App\Forms\UserForm;
use App\Models\User;
use Lib\Controller;
use Lib\Http\{Request, Response};

class UserController extends Controller
{
    public function index(Request $request, Response $response)
    {
        $users = User::all();

        return $response->json($users);
    }

    public function show(Request $request, Response $response, int $id)
    {
        $user = User::findOrFail($id);

        return $response->json($user);
    }

    public function create(Request $request, Response $response)
    {
        $form = UserForm::create($request->getFormJSON());

        if (!$form->validate()) {
            return $response->json([
                'errors' => $form->getErrors(),
            ], 400);
        }

        $user = User::create($request->getFormJSON());

        return $response->json($user);
    }

    public function update(Request $request, Response $response, int $id)
    {
        $user = User::findOrFail($id);

        $form = UserForm::create($request->getFormJSON());

        if (!$form->validate()) {
            return $response->json([
                'errors' => $form->getErrors(),
            ], 400);
        }

        $user->update($request->getFormJSON());

        return $response->json($user);
    }

    public function delete(Request $request, Response $response, int $id)
    {
        $user = User::findOrFail($id);

        $user->delete();

        return $response->noContent();
    }
}
