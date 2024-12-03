<?php

class Products
{
    public function getProducts(): array
    {
        $pdo = new PDO("pgsql:host=postgres; port=5432; dbname=mydb", 'user', 'pass');
        $stmt = $pdo->query("SELECT * FROM products");
        return $stmt->fetchAll();
    }

    public function getByProductId(int $productId): array|false
    {
        $pdo = new PDO("pgsql:host=postgres; port=5432; dbname=mydb", 'user', 'pass');
        $stmt = $pdo->prepare("SELECT * FROM products WHERE id = :product_id");
        $stmt->execute(['product_id' => $productId]);
        return $stmt->fetch();
    }




}