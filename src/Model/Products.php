<?php
namespace Model;
class Products extends Model
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

     public function getAllByIds(array $productIds): array
    {
        $productId = '?' . str_repeat(', ?', count($productIds) - 1); //преобразывает массив  в строку

        $stmt = $this->connectToDatabase()->prepare("SELECT * FROM products WHERE id IN ($productId)");
        $stmt->execute($productIds);
        return $stmt->fetchAll();

    }


}