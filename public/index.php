<?php

if (!file_exists(__DIR__ . '/../vendor/autoload.php')) {
    echo 'Error Autoload';
    exit(1);
}

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../config/env.php';
require __DIR__ . '/../config/database.php';

use App\Controllers\HomeController;
use App\Controllers\Api\{AddressController, UserController};
use App\Controllers\UsersController;
use Lib\Application;

$app = new Application();

$app->router->get('/', [HomeController::class, 'index']);
$app->router->get('/hello/{name}', [HomeController::class, 'hello']);

$app->router->get('/api/user', [UserController::class, 'index']);
$app->router->get('/api/user/{id}', [UserController::class, 'show']);
$app->router->post('/api/user', [UserController::class, 'create']);
$app->router->put('/api/user/{id}', [UserController::class, 'update']);
$app->router->delete('/api/user/{id}', [UserController::class, 'delete']);

$app->router->get('/api/address/{userId}', [AddressController::class, 'index']);
$app->router->get('/api/address/{id}', [UserController::class, 'show']);
$app->router->post('/api/address', [AddressController::class, 'create']);
$app->router->put('/api/address/{id}', [AddressController::class, 'update']);
$app->router->delete('/api/address/{id}', [AddressController::class, 'delete']);

$app->router->get('/users', [UsersController::class, 'index']);

$app->run();
