<?php

namespace Lib\Form;

class Form
{
    private array $data;
    private array $rules;
    private array $errors;

    public function __construct(array $data, array $rules)
    {
        $this->data = $data;
        $this->rules = $rules;
        $this->errors = [];
    }

    public static function create(array $rules, array $data)
    {
        return new self($data, $rules);
    }

    public function validate(): bool
    {
        $result = true;

        /**
         * @var Rule[] $rules
         */
        foreach ($this->rules as $field => $rules) {
            $valueField = $this->data[$field];
            $errors = [];

            foreach ($rules as $rule) {
                if (!$rule->validate($valueField)) {
                    $result = false;
                    $errors[] = $rule->getError();
                }
            }

            $this->setErrors($field, $errors);
        }

        return $result;
    }

    public function getErrors(): array
    {
        return $this->errors;
    }

    public function setErrors(string $field, array $errors)
    {
        $this->errors[$field] = $errors;
    }
}
