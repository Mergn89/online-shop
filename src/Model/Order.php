<?php
require_once './../Model/Database.php';

class Order
{
    private Database $pdo;

    public function __construct()
    {
        $this->pdo = new Database;
    }
    public function createOrder(int $userId, string $contactName, string $address, int $phone): void
    {
        $stmt = $this->pdo->connectToDatabase()->prepare("INSERT INTO orders (user_id, contact_name, address, phone)
                                                 VALUES (:user_id, :contact_name, :address, :phone)");
        $stmt->execute(['user_id' => $userId, 'contact_name' => $contactName, 'address' => $address, 'phone' => $phone]);

    }

    public function getOrderByUserId(int $userId): array|false
    {
        $stmt = $this->pdo->connectToDatabase()->prepare("SELECT id FROM orders WHERE user_id = :user_id");
        $stmt->execute(['user_id' => $userId]);
        return $stmt->fetch();
    }





}