<?php

namespace App\Models;

use Exception;
use App\Lib\Database\Model;
use App\Lib\Database\Database;

/**
 * @property mixed email
 * @property mixed password
 * @property mixed role
 */
class User extends Model
{
    /**
     * @return mixed
     * @throws Exception
     */
    public static function all()
    {
        try {
            $database = Database::getInstance();
            return $database->select('users')->all();
        } catch (Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    /**
     * @param string $email
     * @param string $password
     * @return bool|User
     * @throws Exception
     */
    public static function authenticate(string $email, string $password)
    {
        try {
            $database = Database::getInstance();
            return $database
                ->select('users', null)
                ->where('email', '=', $email)
                ->where('password', '=', $password)
                ->first(User::class);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }
}