<?php

if (!file_exists(__DIR__ . '/../vendor/autoload.php')) {
    echo 'Error Autoload';
    exit(1);
}

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../config/env.php';
require __DIR__ . '/../config/database.php';

use App\Controllers\AddressController;
use App\Controllers\HomeController;
use App\Controllers\UserController;
use Lib\Application;

$app = new Application();

$app->router->get('/', [HomeController::class, 'index']);
$app->router->get('/hello/{name}', [HomeController::class, 'hello']);

$app->router->get('/user', [UserController::class, 'index']);
$app->router->post('/user', [UserController::class, 'create']);
$app->router->put('/user/{id}', [UserController::class, 'update']);
$app->router->delete('/user/{id}', [UserController::class, 'delete']);

$app->router->get('/address/{userId}', [AddressController::class, 'index']);
$app->router->post('/address', [AddressController::class, 'create']);
$app->router->put('/address/{id}', [AddressController::class, 'update']);
$app->router->delete('/address/{id}', [AddressController::class, 'delete']);

$app->run();
