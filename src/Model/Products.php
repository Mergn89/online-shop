<?php
require_once './../Model/Database.php';
class Products extends Database
{
    public function getProducts(): array
    {
        $stmt = $this->connectToDatabase()->query("SELECT * FROM products");
        return $stmt->fetchAll();
    }

    public function getByProductId(int $productId): array|false
    {
        $stmt = $this->connectToDatabase()->prepare("SELECT * FROM products WHERE id = :product_id");
        $stmt->execute(['product_id' => $productId]);
        return $stmt->fetch();
    }




}