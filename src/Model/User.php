<?php
namespace Model;

class User extends Model
{
    public function create(string $name, string $email,string $password): void
    {
        $stmt = $this->connectToDatabase()->prepare("INSERT INTO users (name, email, password) VALUES (:name, :email, :password)");
        $stmt->execute(['name' => $name, 'email' => $email, 'password' => $password]);

    }

    public function getByEmail(string $login): array|false
    {
        $stmt = $this->connectToDatabase()->prepare('SELECT * FROM users WHERE email = :login');
        $stmt->execute(['login' => $login]);
        return $stmt->fetch();
    }

}