<?php

use Illuminate\Database\Capsule\Manager;

$capsule = new Manager;

$capsule->addConnection([
    'driver'    => $_ENV['DB_TYPE'],
    'host'      => $_ENV['DB_HOST'],
    'database'  => $_ENV['DB_NAME'],
    'username'  => $_ENV['DB_USER'],
    'password'  => $_ENV['DB_PASS'],
    'charset'   => $_ENV['DB_CHARSET'],
    'collation' => $_ENV['DB_COLLECTION'],
    'prefix'    => '',
]);

$capsule->setAsGlobal();
$capsule->bootEloquent();
