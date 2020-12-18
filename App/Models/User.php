<?php

namespace App\Models;

use App\Lib\Database\Model;
use App\Lib\Database\Database;
use Envms\FluentPDO\Exception;

/**
 * @property mixed email
 * @property mixed password
 * @property mixed role
 */
class User extends Model
{
    public static function all(): array
    {
        try {
            $database = Database::getInstance();
            $query = $database->fluent->from('users');
            return $query->fetchAll();
        } catch (Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public static function authenticate(string $email, string $password)
    {
        try {
            $database = Database::getInstance();
            $sql = "select * from `users` where `email` = :email and `password` = :password";
            $query = $database->pdo->prepare($sql);
            $result = $query->execute(['email' => $email, 'password' => $password]);
            if ($result) {
                if ($query->rowCount() > 0)
                {
                    return $query->fetchObject(User::class);
                }
            }

            return false;
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }
}