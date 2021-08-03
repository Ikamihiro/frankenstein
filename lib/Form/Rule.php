<?php

namespace Lib\Form;

class Rule
{
    private ?string $error;

    public function getError(): string
    {
        return $this->error ? $this->error : 'No error';
    }

    public function validate($field): bool
    {
        return isset($field);
    }
}
