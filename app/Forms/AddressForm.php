<?php

namespace App\Forms;

use Frankenstein\Validation\Form;
use Frankenstein\Validation\Rules\RequiredRule;

class AddressForm extends Form
{
    public static function create(array $data)
    {
        $rules = [
            'post_code' => [new RequiredRule],
            'street' => [new RequiredRule],
            'neighborhood' => [new RequiredRule],
            'city' => [new RequiredRule],
            'state' => [new RequiredRule],
            'type' => [new RequiredRule],
            'user_id' => [new RequiredRule],
        ];

        return new self($data, $rules);
    }
}
