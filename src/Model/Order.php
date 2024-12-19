<?php
namespace Model;

class Order extends Model
{
    public function createOrder(int $userId, string $contactName, string $address, int $phone, int $total): void
    {
        $stmt = $this->connectToDatabase()->prepare("INSERT INTO orders (user_id, contact_name, address, phone, total)
                                                 VALUES (:user_id, :contact_name, :address, :phone, :total)");
        $stmt->execute(['user_id' => $userId, 'contact_name' => $contactName, 'address' => $address, 'phone' => $phone, 'total' => $total]);

    }

    public function getOrderByUserId(int $userId): array|false
    {
        $stmt = $this->connectToDatabase()->prepare("SELECT * FROM orders WHERE user_id = :user_id");
        $stmt->execute(['user_id' => $userId]);
        return $stmt->fetch();
    }

    public function getAllByUserId(int $userId): array
    {
        $stmt = $this->connectToDatabase()->prepare("SELECT * FROM orders WHERE user_id = :user_id");
        $stmt->execute(['user_id' => $userId]);
        return $stmt->fetchAll();

    }


}