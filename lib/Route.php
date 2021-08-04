<?php

namespace Lib;

class Route
{
    public static function mountUrl(string $endPoint)
    {
        return $_ENV['BASE_URL'] . $endPoint;
    }
}
