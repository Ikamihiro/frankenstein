<?php

namespace App\Lib\Database;

use Envms\FluentPDO\Query;

class Database
{
    private static $singleton;
    public $pdo;
    public $fluent;

    public function __construct()
    {
        $options = array(
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_OBJ,
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_WARNING
        );

        $dsn = getenv('DB_TYPE')
            . ':host=' . getenv('DB_HOST')
            . ';dbname=' . getenv('DB_NAME')
            . ';charset=' . getenv('DB_CHARSET');

        $this->pdo = new \PDO($dsn, getenv('DB_USER'), getenv('DB_PASS'), $options);
        $this->fluent = new Query($this->pdo);
    }

    public static function getInstance(): Database
    {
        if (self::$singleton == null)
        {
            self::$singleton = new Database();
        }

        return self::$singleton;
    }

    public function __wakeup()
    {
        throw new \Exception("Cannot unserialize a singleton.");
    }
}