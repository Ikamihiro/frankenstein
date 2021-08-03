<?php

namespace Lib\Form\Rules;

use Lib\Form\Rule;

class RequiredRule extends Rule
{
    public function validate($field): bool
    {
        return isset($field);
    }
}