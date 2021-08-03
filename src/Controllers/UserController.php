<?php

namespace App\Controllers;

use App\Models\User;
use Lib\Controller;
use Lib\Form\Form;
use Lib\Form\Rules\MaxRule;
use Lib\Form\Rules\RequiredRule;
use Lib\Http\{Request, Response};

class UserController extends Controller
{
    public function index(Request $request, Response $response)
    {
        $users = User::all();

        return $response->json($users);
    }

    public function create(Request $request, Response $response)
    {
        $form = Form::create([
            'first_name' => [new RequiredRule()],
            'last_name' => [new RequiredRule()],
            'phone' => [new RequiredRule()],
            'document' => [new RequiredRule()],
            'birth_date' => [new RequiredRule()],
        ], $request->getFormJSON());

        if (!$form->validate()) {
            return $response->json([
                $form->getErrors(),
            ], 400);
        }

        $user = User::create($request->getFormJSON());

        return $response->json($user);
    }
}
