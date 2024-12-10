<?php
namespace Model;

class OrderProduct extends Model
{

    public function addProductInOrder(int $orderId, int $productId, int $amount, int $orderPrice): void
    {
        $stmt = $this->connectToDatabase()->prepare("INSERT INTO order_products (order_id, product_id, amount, order_price) 
                                                  VALUES (:order_id, :product_id, :amount, :order_price)");
        $stmt->execute(['order_id' => $orderId, 'product_id' => $productId, 'amount' => $amount, 'order_price' => $orderPrice]);
    }

    public function getByOrderId(int $orderId): array
    {
        $stmt = $this->connectToDatabase()->prepare("SELECT * FROM order_products WHERE order_id = :order_id");
        $stmt->execute(['order_id' => $orderId]);
        return $stmt->fetchAll();

    }



}