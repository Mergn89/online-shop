<?php

class OrderProduct
{
    public function addProductInOrder(int $orderId, int $productId, int $amount, int $orderPrice): void
    {
        $pdo = new PDO("pgsql:host=postgres; port=5432; dbname=mydb", 'user', 'pass');
        $stmt = $pdo->prepare("INSERT INTO order_products (order_id, product_id, amount, order_price) 
                              VALUES (:order_id, :product_id, :amount, :order_price)");
        $stmt->execute(['order_id' => $orderId, 'product_id' => $productId, 'amount' => $amount, 'order_price' => $orderPrice]);
    }


}