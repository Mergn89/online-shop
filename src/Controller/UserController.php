<?php
require_once './../Model/User.php';


class UserController
{
    public function getRegistrationForm()
    {
        require_once './../View/registrate.php';

    }

    public function registrate()
    {
        $errors = $this->registrateValidation($_POST);

        if (empty($errors)) {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['psw'];
            $passwordRep = $_POST['psw-repeat'];

            $hash = password_hash($password, PASSWORD_DEFAULT);

            $user = new User();
            $user->create($name,$email,$hash);
            header("location: /login");
            //    print_r($stmt->fetch());
        }
        require_once "./../View/registrate.php";
    }

    private function registrateValidation($post): array
    {
        $errors = [];

        if (isset($post['name'])) {
            $name = $post['name'];
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

        if (isset($post['email'])) {
            $email = $post['email'];
            if (empty($email)) {
                $errors['email'] = 'Поле email не должно быть пустым';
            } elseif (strlen($email) < 5) {
                $errors['email'] = 'Email должен содержать не менее 5 символов';
            } elseif (!preg_match('#^([\w]+\.?)+(?<!\.)@(?!\.)[a-zа-я0-9ё\.-]+\.?[a-zа-яё]{2,}$#ui', $email)) {
                $errors['email'] = 'Недопустимый формат email';
            } else {
                $user = new User();
                $userData = $user->getByEmail($email);

                if (!empty($userData)) {
                    $errors['email'] = 'Такой пользователь уже существует';
                }
            }
        } else {
            $errors = 'Поле должно быть заполнено';
        }

        if (isset($post['psw'])) {
            $password = $post['psw'];
            if (empty($password)) {
                $errors['psw'] = 'Поле должно быть заполнено';
            } elseif (strlen($password) < 5) {
                $errors['psw'] = 'Пароль должен содержать не менее 5 символов';
            }
        } else {
            $errors['psw'] = 'Пожалуйста, заполните поле';
        }

        if (isset($post['psw-repeat'])) {
            $passwordRep = $post['psw-repeat'];
            if (empty($passwordRep)) {
                $errors['psw-repeat'] = 'Поле не должно быть пустым';
            } elseif ($passwordRep !== $password) {
                $errors['psw-repeat'] = 'Пароли не совпадают';
            }
        }
        return $errors;
    }

    public function getLoginForm()
    {
        require_once './../View/login.php';

    }

    public function login()
    {
        $errors = $this->loginValidate($_POST);

        if (empty($errors)) {
            $login = $_POST['login'];
            $password = $_POST['psw'];

            $user = new User();
            $data = $user->getByEmail($login);

            if($data === false) {
                $errors['login'] = 'Пароль или логин неверный';
            } else {
                $hashData = $data['password'];

                if(password_verify($password, $hashData)) {
                    //setcookie('user_id', $data['id']);
                    session_start();
                    $_SESSION['user_id'] = $data['id'];
                    header("location: /catalog");
                } else {
                    $errors['login'] = 'Пароль или логин неверный';
                }
            }
            require_once './../View/login.php';
        }
         //print_r($_SESSION('user_id'));

    }

    function loginValidate(array $post): array
    {
        $errors = [];

        if (isset($post['login'])) {
            $login = $post['login'];
        } else {
            $errors['login'] = 'Логин или пароль неверный';
        }

        if (isset($post['psw'])) {
            $password = $post['psw'];
        } else {
            $errors['psw'] = 'Логин или пароль неверный';
        }
        return $errors;
    }

}