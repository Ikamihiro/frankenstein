<?php

define('ROOT', dirname(__DIR__) . DIRECTORY_SEPARATOR);
define('APP', ROOT . 'App' . DIRECTORY_SEPARATOR);

require_once 'config.php';

if (!file_exists(ROOT . '/vendor/autoload.php')) {
    echo 'Error Autoload';
    exit(1);
}

require_once(ROOT . '/vendor/autoload.php');

use NoahBuscher\Macaw\Macaw;
use App\Lib\Utils\Config;

Config::loadFileEnv();

Macaw::get('/', 'App\Controllers\HomeController@index');
Macaw::get('/about', 'App\Controllers\HomeController@about');

Macaw::get('/login', 'App\Controllers\Auth\LoginController@index');
Macaw::post('/auth', 'App\Controllers\Auth\LoginController@login');
Macaw::get('/logout', 'App\Controllers\Auth\LoginController@logout');

Macaw::dispatch();