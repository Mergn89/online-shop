<?php

namespace Request;

class LoginRequest extends Request
{
    public function getLogin(): ?string
    {
        return $this->data['login'] ?? '';
    }

    public function getPassword(): ?string
    {
        return $this->data['psw'] ?? '';
    }

    function validate(): array
    {
        $data = $this->data;
        $errors = [];

        if (isset($data['login'])) {
            $login = $data['login'];
        } else {
            $errors['login'] = 'Логин или пароль неверный';
        }

        if (isset($data['psw'])) {
            $password = $data['psw'];
        } else {
            $errors['psw'] = 'Логин или пароль неверный';
        }
        return $errors;
    }

}