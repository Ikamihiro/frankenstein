<?php

namespace App\Forms;

use Frankenstein\Validation\Form;
use Frankenstein\Validation\Rules\RequiredRule;

class UserForm extends Form
{
    public static function create(array $data)
    {
        $rules = [
            'first_name' => [new RequiredRule],
            'last_name' => [new RequiredRule],
            'email' => [new RequiredRule],
            'phone' => [new RequiredRule],
            'document' => [new RequiredRule],
            'birth_date' => [new RequiredRule],
        ];

        return new self($data, $rules);
    }
}
