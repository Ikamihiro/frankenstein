<?php

namespace App\Lib\Database;

use Exception;

/**
 * Class Model
 * @package App\Lib\Database
 */
class Model implements ModelContract
{
    protected $primarykey = 'id';
    protected $table;
    protected $columns = [];
    protected $attributes = [];

    public function __construct($attributes = array())
    {
        if(!empty($attributes))
        {
            foreach ($attributes as $key => $value)
            {
                $this->{$key} = $value;
            }
        }
    }

    /**
     * @param $name
     * @param $value
     * @return $this
     */
    public function __set($name, $value): Model
    {
        $this->attributes[$name] = $value;
        return $this;
    }

    /**
     * @param $name
     * @return mixed
     */
    public function __get($name)
    {
        if (isset($this->attributes[$name]))
        {
            return $this->attributes[$name];
        }

        return null;
    }

    /**
     * @param $name
     * @return bool
     */
    public function __isset($name): bool
    {
        return isset($this->attributes[$name]);
    }

    /**
     * @return array|mixed
     * @throws Exception
     */
    public function all(): array
    {
        try {
            $database = Database::getInstance();

            return $database->select($this->table)->all();
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     * @param $id
     * @return mixed|void
     * @throws Exception
     */
    public function find($id)
    {
        try {
            $database = Database::getInstance();

            return $database->select($this->table)
                ->where($this->primarykey, '=', $id)
                ->first(self::class);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     * @return bool|mixed
     * @throws Exception
     */
    public function save(): bool
    {
        try {
            $database = Database::getInstance();

            $result = $this->performInsert();

            if ($result) {
                $this->{$this->primarykey} = $database->lastIdInserted();
            }

            return $result;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     * @throws Exception
     * @return bool|mixed
     */
    private function performInsert(): bool
    {
        try {
            $database = Database::getInstance();

            return $database->insert(
                $this->table,
                $this->columns,
                $this->attributes,
            )->do();
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     * @throws Exception
     * @return bool|mixed
     */
    public function update(): bool
    {
        try {
            return $this->performUpdate();
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     * @throws Exception
     * @return bool|mixed
     */
    private function performUpdate(): bool
    {
        try {
            $database = Database::getInstance();

            $data = [];

            foreach ($this->columns as $column)
            {
                $data[$column] = $this->attributes[$column];
            }

            return $database->update($this->table, $data)
                ->where($this->primarykey, '=', $this->{$this->primarykey})
                ->do();
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public static function delete($id)
    {
        // TODO: Implement delete() method.
    }
}