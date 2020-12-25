<?php

define('ENVIRONMENT', 'development');

if (ENVIRONMENT == 'development' || ENVIRONMENT == 'dev') {
    error_reporting(E_ALL);
    ini_set("display_errors", 1);
}

define('URL_PUBLIC_FOLDER', 'public');
define('URL_PROTOCOL', 'http://');
define('URL_DOMAIN', $_SERVER['HTTP_HOST']);
define('URL_SUB_FOLDER', str_replace(URL_PUBLIC_FOLDER, '', dirname($_SERVER['SCRIPT_NAME'])));
define('URL', URL_PROTOCOL . URL_DOMAIN . URL_SUB_FOLDER);

define('URL_BASE', URL);

function debug($value, ...$values)
{
    var_dump($value, ...$values);
    die();
}

function refreshArray(array $array): array
{
    $arrayRefreshed = array();

    foreach ($array as $key => $value) {
        $arrayRefreshed[$key] = $value;
    }

    return $arrayRefreshed;
}

function contains(string $needle, string $haystack): bool
{
    return strpos($haystack, $needle) !== false;
}