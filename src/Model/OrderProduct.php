<?php
require_once './../Model/Database.php';

class OrderProduct
{
    private Database $pdo;

    public function __construct()
    {
        $this->pdo = new Database;
    }
    public function addProductInOrder(int $orderId, int $productId, int $amount, int $orderPrice): void
    {
        $stmt = $this->pdo->connectToDatabase()->prepare("INSERT INTO order_products (order_id, product_id, amount, order_price) 
                                                  VALUES (:order_id, :product_id, :amount, :order_price)");
        $stmt->execute(['order_id' => $orderId, 'product_id' => $productId, 'amount' => $amount, 'order_price' => $orderPrice]);
    }


}