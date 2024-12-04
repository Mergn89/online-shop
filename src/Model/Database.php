<?php

class Database
{
    private PDO $pdo;
    public function __construct(){
        $this->pdo = new PDO('pgsql:host=postgres;port=5432;dbname=mydb', 'user', 'pass');
    }
    public function connectToDatabase(): PDO
    {
        return $this->pdo;
    }

}