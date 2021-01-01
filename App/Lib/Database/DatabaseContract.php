<?php

namespace App\Lib\Database;

/**
 * Interface DatabaseContract
 * @package App\Lib\Database
 */
interface DatabaseContract
{
    /**
     * @param string $table
     * @param array|null $columns
     * @return mixed
     */
    public function select(string $table, array $columns = null);

    /**
     * @param $column
     * @param $condition
     * @param $value
     * @return mixed
     */
    public function where(string $column, string $condition, $value);

    /**
     * @param string $table
     * @param array|mixed $columns
     * @param array|mixed $data
     * @return mixed
     */
    public function insert(string $table, $columns = null, $data = null);

    /**
     * @param string $table
     * @param array|mixed $data
     * @return mixed
     */
    public function update(string $table, $data = null);

    /**
     * @param string $table
     * @return mixed
     */
    public function delete(string $table);

    /**
     * @return mixed
     */
    public function all();

    /**
     * @param string $class
     * @return mixed
     */
    public function first($class = null);
}