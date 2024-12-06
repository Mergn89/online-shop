<?php
require_once './../Model/Database.php';
class Products
{
    private Database $pdo;

    public function __construct()
    {
        $this->pdo = new Database;
    }
    public function getProducts(): array
    {
        $stmt = $this->pdo->connectToDatabase()->query("SELECT * FROM products");
        return $stmt->fetchAll();
    }

    public function getByProductId(int $productId): array|false
    {
        $stmt = $this->pdo->connectToDatabase()->prepare("SELECT * FROM products WHERE id = :product_id");
        $stmt->execute(['product_id' => $productId]);
        return $stmt->fetch();
    }




}