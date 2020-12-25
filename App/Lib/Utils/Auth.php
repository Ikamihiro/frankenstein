<?php

namespace App\Lib\Utils;

use App\Lib\Http\Session;
use App\Models\User;
use Exception;

class Auth
{
    private static $singleton;
    private $levels;
    private $user;

    public function __construct(array $levels)
    {
        $this->levels = $levels;
        $this->user = null;
    }

    public static function getInstance(): Auth
    {
        if (self::$singleton == null)
        {
            self::$singleton = new Auth([
                'ADMIN',
                'USER',
            ]);
        }

        return self::$singleton;
    }

    /**
     * @param string $email
     * @param string $password
     * @return bool
     * @throws Exception
     */
    public function login(string $email, string $password): bool
    {
        try {
            $passwordHash = md5($password);
            $user = User::authenticate($email, $passwordHash);

            if ($user) {
                $this->setUserInSession($user);
                return true;
            }

            return false;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function logout(): bool
    {
        Session::init();
        if (Session::get('isAuthenticated'))
        {
            Session::set('isAuthenticated', false);
            Session::clear('email');
            Session::clear('role');
            Session::clear('userJson');
        }

        return true;
    }

    public function lock(): void
    {
        Session::init();
        if (!Session::get('isAuthenticated'))
        {
            header('Location: ' . URL . 'login');
        }
    }

    public function onlyGuest(): void
    {
        Session::init();
        if (Session::get('isAuthenticated'))
        {
            header('Location: ' . URL);
        }
    }

    public function authorize($role): void
    {
        Session::init();
        if ($this->levels[$role] != Session::get('role'))
        {
            header('Location: ' . URL);
        }
    }

    private function setUserInSession(User $user)
    {
        Session::init();
        if (!Session::get('isAuthenticated'))
        {
            Session::set('isAuthenticated', true);
            Session::set('email', $user->email);
            Session::set('role', $user->role);
            Session::set('userJson', json_encode($user));
        }
    }

    public function getLevels(): array
    {
        return $this->levels;
    }

    public function setLevels(array $levels)
    {
        $this->levels = $levels;
    }

    public function addLevel($level)
    {
        $this->levels[] = $level;
    }
}