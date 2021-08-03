<?php

if (!file_exists(__DIR__ . '/../vendor/autoload.php')) {
    echo 'Error Autoload';
    exit(1);
}

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../config/env.php';
require __DIR__ . '/../config/database.php';

use App\Controllers\HomeController;
use App\Controllers\UserController;
use Lib\Application;

$app = new Application();

$app->router->get('/', [HomeController::class, 'index']);
$app->router->get('/hello/{name}', [HomeController::class, 'hello']);
$app->router->post('/user', [UserController::class, 'create']);

$app->run();
