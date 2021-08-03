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

    public function create(array $rules, array $data)
    {
        return new self($data, $rules);
    }

    public function validate(): bool
    {
        $result = true;

        /**
         * @var Rule $rule
         */
        foreach ($this->rules as $field => $rule) {
            $valueField = $this->data[$field];
            $result = $rule->validate($valueField);

            if ($result) {
                $this->errors[] = $rule->getError();
                $result = false;
            }
        }

        return $result;
    }
}
