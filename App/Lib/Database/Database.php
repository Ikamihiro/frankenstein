<?php

namespace App\Lib\Database;

use Exception;
use PDOStatement;

/**
 * Class Database
 * @package App\Lib\Database
 */
class Database implements DatabaseContract
{
    private static $singleton;
    public $databaseConnection;
    public $sql;

    /**
     * Database constructor.
     */
    public function __construct()
    {
        $this->databaseConnection = Connection::getInstance();
        $this->sql = '';
    }

    /**
     * @return Database
     */
    public static function getInstance(): Database
    {
        if (self::$singleton == null)
        {
            self::$singleton = new Database();
        }

        return self::$singleton;
    }

    /**
     * @throws Exception
     */
    public function __wakeup()
    {
        throw new Exception("Cannot unserialize a singleton.");
    }

    /**
     * @param $column
     * @param $condition
     * @param $value
     * @return Database
     * @throws Exception
     */
    public function where(string $column, string $condition, $value): Database
    {
        if (empty($this->sql))
        {
            throw new Exception("Clause WHERE can't be single");
        }

        if (contains('WHERE', $this->sql))
        {
            $where = "AND ";
        } else {
            $where = "WHERE ";
        }

        if (is_string($value))
        {
            $value = "'{$value}'";
        }

        $where .= "{$column} {$condition} {$value} ";

        $this->sql .= $where;

        return $this;
    }

    /**
     * @param string $table
     * @param array|null $columns
     * @return Database
     */
    public function select(string $table, array $columns = null): Database
    {
        if (!$columns)
        {
            $fields = '*';
        } else {
            $fields = implode(', ', $columns);
        }

        $sql = "SELECT {$fields} FROM {$table} ";

        $this->sql = $sql;

        return $this;
    }

    /**
     * @param string $table
     * @param array|mixed $columns
     * @param array|mixed $data
     * @return Database|mixed
     * @throws Exception
     */
    public function insert(string $table, $columns = null, $data = null): Database
    {
        $sql = "INSERT INTO {$table} ";

        if ($columns) {
            $fields = implode(', ', $columns);
            $sql .= "({$fields}) ";
        }

        if (!$data)
        {
            throw new Exception('Insert method without data');
        }

        $values = $this->formatDataToQuery($data);

        $sql .= "VALUES ({$values}) ";
        $this->sql = $sql;

        return $this;
    }

    /**
     * @param string $table
     * @param array|mixed $data
     * @return Database|mixed
     * @throws Exception
     */
    public function update(string $table, $data = null): Database
    {
        $sql = "UPDATE {$table} SET ";

        if (!$data)
        {
            throw new Exception('Update method without data');
        }

        foreach ($data as $key => $value)
        {
            if (is_string($value))
            {
                $valueFormated = "'{$value}'";
            } else {
                $valueFormated = $value;
            }

            if (array_key_last($data) == $key)
            {
                $sql .= "{$key} = {$valueFormated} ";
            }
            else
            {
                $sql .= "{$key} = {$valueFormated}, ";
            }
        }

        $this->sql = $sql;

        return $this;
    }

    /**
     * @param string $table
     * @return Database|mixed
     */
    public function delete(string $table): Database
    {
        $sql = "DELETE FROM {$table} ";
        $this->sql = $sql;
        return $this;
    }

    /**
     * @return array
     * @throws Exception
     */
    public function all(): array
    {
        try {
            $result = $this->databaseConnection->run($this->sql);
            return $result->fetchAll();
        } catch (Exception $e) {
            $error = 'Erro: ' . $e->getMessage()
                . '<br>'
                . "SQL: {$this->sql}";
            throw new Exception($error);
        }
    }

    /**
     * @param string $class
     * @return mixed|void
     * @throws Exception
     */
    public function first($class = null)
    {
        try {
            $result = $this->databaseConnection->run($this->sql);

            if (is_null($class))
            {
                return $result->fetch();
            } else {
                return $result->fetchObject($class);
            }
        } catch (Exception $e) {
            $error = 'Erro: ' . $e->getMessage() . '<br>'
                . "SQL: {$this->sql}";
            throw new Exception($error);
        }
    }

    /**
     * @param array $data
     * @return string
     */
    private function formatDataToQuery(array $data): string
    {
        $values = '';

        foreach ($data as $key => $value)
        {
            if (is_string($value))
            {
                $valueFormated = "'{$value}'";
            } else {
                $valueFormated = $value;
            }

            if (array_key_last($data) == $key)
            {
                $values .= "{$valueFormated}";
            } else {
                $values .= "{$valueFormated}, ";
            }
        }

        return $values;
    }

    /**
     * @return bool|mixed
     * @throws Exception
     */
    public function do(): bool
    {
        try {
            $result = $this->databaseConnection->run($this->sql);

            if ($result) {
                return true;
            }

            return false;
        } catch (Exception $e) {
            $error = "Erro: {$e->getMessage()} <br>"
                . "SQL: {$this->sql}";
            throw new Exception($error);
        }
    }
}