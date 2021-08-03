<?php

namespace App\Forms;

use Lib\Form\Form;
use Lib\Form\Rules\RequiredRule;

class UserForm extends Form
{
    public static function create(array $data)
    {
        $rules = [
            'first_name' => [new RequiredRule],
            'last_name' => [new RequiredRule],
            'phone' => [new RequiredRule],
            'document' => [new RequiredRule],
            'birth_date' => [new RequiredRule],
        ];

        // TODO: Disparar exceção caso não valide formulário

        return new self($data, $rules);
    }
}
