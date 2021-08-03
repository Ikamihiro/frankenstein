<?php

namespace App\Controllers\Api;

use App\Forms\AddressForm;
use App\Models\Address;
use Lib\Controller;
use Lib\Http\{Request, Response};

class AddressController extends Controller
{
    public function index(Request $request, Response $response, int $userId)
    {
        $addresses = Address::where('user_id', $userId)->get();

        return $response->json($addresses);
    }

    public function create(Request $request, Response $response)
    {
        $form = AddressForm::create($request->getFormJSON());

        if (!$form->validate()) {
            return $response->json([
                $form->getErrors(),
            ], 400);
        }

        $address = Address::create($request->getFormJSON());

        return $response->json($address->load('user'));
    }

    public function update(Request $request, Response $response, int $id)
    {
        $address = Address::findOrFail($id);

        $form = AddressForm::create($request->getFormJSON());

        if (!$form->validate()) {
            return $response->json([
                $form->getErrors(),
            ], 400);
        }

        $address->update($request->getFormJSON());

        return $response->json($address->load('user'));
    }

    public function delete(Request $request, Response $response, int $id)
    {
        $address = Address::findOrFail($id);

        $address->delete();

        return $response->noContent();
    }
}
