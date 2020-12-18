<?php

namespace App\Lib\Database;

class Model
{
    private $attributes;

    public function __set($name, $value): Model
    {
        $this->attributes[$name] = $value;
        return $this;
    }

    public function __get($name)
    {
        return $this->attributes[$name];
    }

    public function __isset($name): bool
    {
        return isset($this->attributes[$name]);
    }
}