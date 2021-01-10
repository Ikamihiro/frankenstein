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
    protected $primarykey = 'id';
    protected $table = 'users';
    protected $columns = ['email', 'password', 'role'];

    public static function factory(): User
    {
        return new self();
    }

    /**
     * @param string $email
     * @param string $password
     * @return bool|User
     * @throws Exception
     */
    public function authenticate(string $email, string $password)
    {
        try {
            $database = Database::getInstance();
            return $database
                ->select($this->table, null)
                ->where('email', '=', $email)
                ->where('password', '=', $password)
                ->first(User::class);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }
}