<?php

namespace Lib\Form;

class Rule
{
    private ?string $error;

    public function getError(): string
    {
        return $this->error ? $this->error : 'No error';
    }

    public function setError(string $error): void
    {
        $this->error = $error;
    }

    public function validate($field): bool
    {
        return isset($field);
    }
}
