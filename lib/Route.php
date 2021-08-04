<?php

namespace Lib;

class Route
{
    public static function mountUrl(string $endPoint)
    {
        $baseUrl = $_ENV['BASE_URL'] ?? 'http://127.0.0.1:3456';
        return "$baseUrl/$endPoint";
    }
}
