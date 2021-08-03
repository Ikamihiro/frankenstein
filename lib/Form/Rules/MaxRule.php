<?php

namespace Lib\Form\Rules;

use Lib\Form\Rule;

class MaxRule extends Rule
{
    public function validate($field, int $max = 250): bool
    {
        if (is_string($field)) {
            return strlen($field) <= $max;
        }

        return count($field) <= $max;
    }
}
