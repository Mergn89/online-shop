<?php

namespace Request;

//use http\Client\Curl\User;

use Model\User;

class RegistrateRequest extends Request
{
//    public function __construct(string $uri, string $method, array $data = [])
//    {
//        parent::__construct($uri, $method, $data);
//    }

    public function getName(): ?string
    {
        return $this->data['name'] ?? '';
    }
    public function getEmail(): ?string
    {
        return $this->data['email'] ?? '';
    }
    public function getPassword(): ?string
    {
        return $this->data['psw'] ?? '';
    }
    public function getPasswordRepeat(): ?string
    {
        return $this->data['psw-repeat'] ?? '';
    }



    public function validate(): array
    {
        $data = $this->data;
        $errors = [];

        if (isset($data['name'])) {
            $name = $data['name'];
            if (empty($name)) {
                $errors['name'] = 'Имя не должно быть пустым';
            } elseif (strlen($name) < 4) {
                $errors['name'] = 'Имя должно содержать не менее 4 символов';
            } elseif (preg_match("/[^(\w)|(\x7F-\xFF)|(\s)]/", $name)) {
                $errors['name'] = 'В имени недопустимый символ';
            }
        } else {
            $errors['name'] = 'Поле name должно быть заполнено';
        }

        if (isset($data['email'])) {
            $email = $data['email'];
            if (empty($email)) {
                $errors['email'] = 'Поле email не должно быть пустым';
            } elseif (strlen($email) < 5) {
                $errors['email'] = 'Email должен содержать не менее 5 символов';
            } elseif (!preg_match('#^([\w]+\.?)+(?<!\.)@(?!\.)[a-zа-я0-9ё\.-]+\.?[a-zа-яё]{2,}$#ui', $email)) {
                $errors['email'] = 'Недопустимый формат email';
            } else {
                $user = User::getByEmail($email);

                if ($user) {
                    $errors['email'] = 'Такой пользователь уже существует';
                }
            }
        } else {
            $errors = 'Поле должно быть заполнено';
        }

        if (isset($data['psw'])) {
            $password = $data['psw'];
            if (empty($password)) {
                $errors['psw'] = 'Поле должно быть заполнено';
            } elseif (strlen($password) < 5) {
                $errors['psw'] = 'Пароль должен содержать не менее 5 символов';
            }
        } else {
            $errors['psw'] = 'Пожалуйста, заполните поле';
        }

        if (isset($data['psw-repeat'])) {
            $passwordRep = $data['psw-repeat'];
            if (empty($passwordRep)) {
                $errors['psw-repeat'] = 'Поле не должно быть пустым';
            } elseif ($passwordRep !== $password) {
                $errors['psw-repeat'] = 'Пароли не совпадают';
            }
        }
        return $errors;
    }
}