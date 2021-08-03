<?php

namespace App\Controllers;

use Lib\Controller;
use Lib\Form\Form;
use Lib\Form\Rules\RequiredRule;
use Lib\Http\{Request, Response};

class UserController extends Controller
{
    public function index(Request $request, Response $response)
    {
        return $response->json('Hello Word');
    }

    public function create(Request $request, Response $response)
    {
        $form = Form::create([
            'name' => new RequiredRule(),
            'email' => new RequiredRule(),
        ], $request->getFormJSON());

        $result = $form->validate();

        if (!$result) {
            return $response->json([
                $form->getErrors(),
            ], 400);
        }
    }
}
