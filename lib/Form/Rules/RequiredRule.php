<?php

namespace Lib\Form\Rules;

use Lib\Form\Rule;

class RequiredRule extends Rule
{
    public function validate($field): bool
    {
        $validation = isset($field);

        if (!$validation) {
            $this->setError("Value can't be null!");
        }

        return $validation;
    }
}
