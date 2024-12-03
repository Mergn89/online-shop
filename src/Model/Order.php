<?php

class Order
{
    public function createOrder(int $userId, string $contactName, string $address, int $phone): void
    {
        $pdo = new PDO("pgsql:host=postgres; port=5432; dbname=mydb", 'user', 'pass');
        $stmt = $pdo->prepare("INSERT INTO orders (user_id, contact_name, address, phone)
                                                 VALUES (:user_id, :contact_name, :address, :phone)");
        $stmt->execute(['user_id' => $userId, 'contact_name' => $contactName, 'address' => $address, 'phone' => $phone]);

    }

    public function getOrderByUserId(int $userId): array|false
    {
        $pdo = new PDO("pgsql:host=postgres; port=5432; dbname=mydb", 'user', 'pass');
        $stmt = $pdo->prepare("SELECT id FROM orders WHERE user_id = :user_id");
        $stmt->execute(['user_id' => $userId]);
        return $stmt->fetch();
    }





}