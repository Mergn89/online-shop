<?php
namespace Controller;
use Model\User;
use Request\RegistrateRequest;
use Request\LoginRequest;
use Request\Request;
use Service\AuthService;

class UserController
{
    private User $user;
    private AuthService $authService;

    public function __construct()
    {
        $this->user = new User();
        $this->authService = new AuthService();
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

            if (!($this->authService->login($login, $password))) {
                $errors['login'] = 'Пароль или логин неверный';
            } else {
                header("location: /catalog");
            }
            require_once './../View/login.php';
        }
    }

    public function logout():void
    {
        session_start();
        session_unset();
        session_destroy();
        header ("Location: ./login");
    }

}