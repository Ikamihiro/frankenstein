<?php

namespace App\Lib\Http;

class Session
{
    public static function init(): void
    {
        if(!isset($_SESSION))
        {
            session_start();
        }
    }

    public static function get(string $key): bool
    {
        if(isset($_SESSION[$key]))
        {
            return $_SESSION[$key];
        } else {
            return false;
        }
    }

    public static function set(string $key, $value)
    {
        $_SESSION[$key] = $value;
    }

    public static function clear(string $key)
    {
        $_SESSION[$key] = null;
    }

    public static function destroy(): void
    {
        session_destroy();
    }
}