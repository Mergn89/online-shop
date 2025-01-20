<?php
namespace Model;
use PDO;
class Model
{
    protected static PDO $pdo;

    public static function connectToDatabase(): PDO
    {
        if(!isset(self::$pdo)) {
            Model::$pdo = new PDO('pgsql:host=postgres;port=5432;dbname=mydb', 'user', 'pass');
        }

        return self::$pdo;
    }

}