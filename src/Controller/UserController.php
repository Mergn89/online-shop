<?php
namespace Controller;
use Model\User;
use Request\RegistrateRequest;
use Request\LoginRequest;
use Request\Request;

class UserController
{
    private User $user;

    public function __construct()
    {
        $this->user = new User();
    }

    public function getRegistrationForm():void
    {
        require_once './../View/registrate.php';

    }

    public function registrate(RegistrateRequest $request):void
    {
        $errors = $request->validate();

        if (empty($errors)) {
            $name = $request->getName();
            $email = $request->getEmail();
            $password = $request->getPassword();
            $passwordRep = $request->getPasswordRepeat();

            $hash = password_hash($password, PASSWORD_DEFAULT);

            $this->user->create($name,$email,$hash);
            header("location: /login");

        }
        require_once "./../View/registrate.php";
    }



    public function getLoginForm():void
    {
        require_once './../View/login.php';
    }

    public function login(LoginRequest $request):void
    {
        $errors = $request->validate();

        if (empty($errors)) {
            $login = $request->getLogin();
            $password = $request->getPassword();

            $user = $this->user->getByEmail($login);

            if(!$user) {
                $errors['login'] = 'Пароль или логин неверный';
            } else {
                $hashData = $user->getPassword();

                if(password_verify($password, $hashData)) {
                    //setcookie('user_id', $data['id']);
                    session_start();
                    $_SESSION['user_id'] = $user->getId();
                    header("location: /catalog");
                } else {
                    $errors['login'] = 'Пароль или логин неверный';
                }
            }
            require_once './../View/login.php';
        }
        //print_r($_SESSION('user_id'));
    }

    public function logout():void
    {
        session_start();
        session_unset();
        session_destroy();
        header ("Location: ./login");
    }

}