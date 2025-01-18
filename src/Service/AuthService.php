<?php

namespace Service;

use Model\User;

class AuthService
{
    private User $user;
    public function __construct()
    {
        $this->user = new User();
    }
    public function check(): bool
    {
        $this->sessionStart();
        return isset($_SESSION['user_id']);
    }

    public function getCurrentUser(): ?User
    {
        if(!$this->check()) {
            return null;
        }

        $this->sessionStart();
        $userId = $_SESSION['user_id'];

        return User::getById($userId);

    }
    public function login(string $login, string $password): bool
    {
        $user = User::getByEmail($login);

        if(!$user) {
            //$errors['login'] = "Логин или пароль неверный";
            return false;

        } elseif (password_verify($password, $user->getPassword())) {
            session_start();
            $_SESSION['user_id'] = $user->getId();
            return true;

        } else {
            //$errors['login'] = "Логин или пароль неверный";
            return false;
        }

    }

    private function sessionStart(): void
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }

    }







}