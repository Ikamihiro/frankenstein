<?php

require __DIR__ . '/../vendor/autoload.php';

use App\Controllers\HomeController;
use Lib\Application;

$app = new Application();

$app->router->get('/', [HomeController::class, 'index']);
$app->router->get('/hello/{name}', [HomeController::class, 'hello']);

$app->run();
