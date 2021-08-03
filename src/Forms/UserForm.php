<?php

namespace App\Forms;

use Lib\Form\Form;
use Lib\Form\Rules\RequiredRule;

class UserForm extends Form
{
    public static function create(array $data)
    {
        $rules = [
            'post_code' => [new RequiredRule],
            'street' => [new RequiredRule],
            'neighborhood' => [new RequiredRule],
            'city' => [new RequiredRule],
            'state' => [new RequiredRule],
            'user_id' => [new RequiredRule],
        ];

        return new self($data, $rules);
    }
}
