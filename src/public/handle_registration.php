<?php

$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['psw'];
$passwordRep = $_POST['psw-repeat'];


$pdo = new PDO('pgsql:host=postgres;port=5432;dbname=mydb', 'user', 'pass');

//$stmt = $pdo->prepare("INSERT INTO users (name, email, password) VALUES (:name, :email, :password)");
//$hash = password_hash($password, PASSWORD_DEFAULT);
//$stmt->execute(['name' => $name, 'email' => $email, 'password' => $hash]);


$stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
$stmt->execute(['email' => $email]);
print_r($stmt->fetch());


//$arr = [ [id] => 1 [0] => 1
//         [name] => Jack [1] => Jack
//         [email] => jack@mail.com [2] => jack@mail.com
//         [password] => 123 [3] => 123
//       ];


