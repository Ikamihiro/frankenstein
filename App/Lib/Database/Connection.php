<?php

namespace App\Lib\Database;

use PDO;
use Exception;
use PDOStatement;

/**
 * Class Connection
 * @package App\Lib\Database
 */
class Connection
{
    public static $singleton;
    public $pdo;

    /**
     * Connection constructor.
     */
    public function __construct()
    {
        $options = array(
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_EMULATE_PREPARES => FALSE,
        );

        $dsn = getenv('DB_TYPE')
            . ':host=' . getenv('DB_HOST')
            . ';dbname=' . getenv('DB_NAME')
            . ';charset=' . getenv('DB_CHARSET');

        $this->pdo = new PDO($dsn, getenv('DB_USER'), getenv('DB_PASS'), $options);
    }

    /**
     * @return Connection
     */
    public static function getInstance(): Connection
    {
        if (is_null(self::$singleton))
        {
            self::$singleton = new Connection();
        }

        return self::$singleton;
    }

    /**
     * @param $sql
     * @return false|PDOStatement
     * @throws Exception
     */
    public function run($sql)
    {
        try
        {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            return $stmt;
        } catch (Exception $e) {
            debug($e);
            throw new Exception($e->getMessage());
        }
    }

    /**
     * @throws Exception
     */
    public function __wakeup()
    {
        throw new Exception("Cannot unserialize a singleton.");
    }

    /**
     * @param $method
     * @param $arguments
     */
    public static function __callStatic($method, $arguments)
    {
        call_user_func_array(array(self::$singleton, $method), $arguments);
    }
}