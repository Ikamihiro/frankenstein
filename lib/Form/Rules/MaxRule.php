<?php

namespace Lib\Form\Rules;

use Lib\Form\Rule;

class MaxRule extends Rule
{
    public function validate($field, int $max = 250): bool
    {
        if (!$field) {
            $this->setError("Value cannot be longer than $max characters");
            return false;
        }

        $validation = true;

        if (is_string($field)) {
            $validation = strlen($field) <= $max;
        } else {
            $validation = count($field) <= $max;
        }

        if (!$validation) {
            $this->setError("Value cannot be longer than $max characters");
        }

        return $validation;
    }
}
