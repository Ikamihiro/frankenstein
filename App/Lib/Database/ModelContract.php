<?php

namespace App\Lib\Database;

interface ModelContract
{
    public function all();

    public function find($id);

    public function save();

    public function update();

    public static function delete($id);
}