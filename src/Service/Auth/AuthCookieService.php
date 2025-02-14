<?php

namespace Service\Auth;

use Mergen\Core\AuthServiceInterface;
use Model\User;

class AuthCookieService implements AuthServiceInterface
{
    public function check(): bool
    {
        return isset($_COOKIE['user_id']);
    }

    public function getCurrentUser(): ?User
    {
        if(!$this->check()) {
            return null;
        }
        $userId = $_COOKIE['user_id'];

        return User::getById($userId);

    }

    public function login(string $login, string $password): bool
    {
        $user = User::getByEmail($login);

        if($user && password_verify($password, $user->getPassword())) {
            setcookie('user_id', $user->getId());

            return true;
        }
        return false;
    }


}

