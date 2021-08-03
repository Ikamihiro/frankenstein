<?php

require __DIR__ . '/../vendor/autoload.php';

use Dotenv\Dotenv;
use App\Controllers\HomeController;
use App\Controllers\UserController;
use Lib\Application;

$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

$app = new Application();

$app->router->get('/', [HomeController::class, 'index']);
$app->router->get('/hello/{name}', [HomeController::class, 'hello']);
$app->router->post('/user', [UserController::class, 'create']);

$app->run();
