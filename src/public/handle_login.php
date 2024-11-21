<?php

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

$errors = loginValidate($_POST);

if (empty($errors)) {
    $login = $_POST['login'];
    $password = $_POST['psw'];

    $pdo = new PDO("pgsql:host=postgres; port=5432; dbname=mydb", 'user', 'pass');

    $stmt = $pdo->prepare('SELECT * FROM users WHERE email = :login');
    $stmt->execute(['login' => $login]);

    $data = $stmt->fetch();

    if($data === false) {
        $errors['login'] = 'Пароль или логин неверный';
    } else {
        $hashData = $data['password'];

        if(password_verify($password, $hashData)) {
            setcookie('user_id', $data['id']);
            session_start();
            $_SESSION['user_id'] = $data['id'];
            header("location: /catalog");
        } else {
            $errors['login'] = 'Пароль или логин неверный';
        }
    }

}
//print_r($_SESSION('user_id'));
require_once './get_login.php';