<?php

namespace Lib\Http;

class Request
{
    public function getMethod()
    {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }

    public function getUrl()
    {
        $path = $_SERVER['REQUEST_URI'];
        $position = strpos($path, '?');

        if ($position !== false) {
            $path = substr($path, 0, $position);
        }

        return $path;
    }

    public function getQuery()
    {
        $data = [];

        foreach ($_GET as $key => $value) {
            $data[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
        }

        return $data;
    }

    public function getForm()
    {
        $data = [];

        foreach ($_POST as $key => $value) {
            $data[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
        }

        return $data;
    }

    public function getFormJSON()
    {
        $json = file_get_contents('php://input');
        $data = json_decode($json, true);
        return $data;
    }
}
