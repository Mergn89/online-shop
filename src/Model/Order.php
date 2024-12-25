<?php
namespace Model;

class Order extends Model
{
    private int $id;
    private string $contactName;
    private string $address;
    private int $phone;
    private int $total;

    public function getId(): int
    {
        return $this->id;
    }
    public function getContactName(): string
    {
        return $this->contactName;
    }

    public function getAddress(): string
    {
        return $this->address;
    }

    public function getPhone(): int
    {
        return $this->phone;
    }

    public function getTotal(): int
    {
        return $this->total;
    }
    public function setId(int $id): Order
    {
        $this->id = $id;
        return $this;
        //return self::setId($id);
    }

    public function setContactName(string $contactName): Order
    {
        $this->contactName = $contactName;
        return $this;
    }

    public function setAddress(string $address): Order
    {
        $this->address = $address;
        return $this;
    }

    public function setPhone(int $phone): Order
    {
        $this->phone = $phone;
        return $this;
    }

    public function setTotal(int $total): Order
    {
        $this->total = $total;
        return $this;
    }

    public function hydrate(array $data): self
    {
        $order = new Order();
        $order->id = $data['id'];
        $order->contactName = $data['contact_name'];
        $order->address = $data['address'];
        $order->phone = $data['phone'];
        $order->total = $data['total'];
        return $order;
    }

    public function createOrder(int $userId, string $contactName, string $address, int $phone, int $total): void
    {
        $stmt = $this->connectToDatabase()->prepare("INSERT INTO orders (user_id, contact_name, address, phone, total)
                                                 VALUES (:user_id, :contact_name, :address, :phone, :total)");
        $stmt->execute(['user_id' => $userId, 'contact_name' => $contactName, 'address' => $address, 'phone' => $phone, 'total' => $total]);
    }

    public function getOrderByUserId(int $userId): self|null
    {
        $stmt = $this->connectToDatabase()->prepare("SELECT * FROM orders WHERE user_id = :user_id");
        $stmt->execute(['user_id' => $userId]);
        $data = $stmt->fetch();
        if($data === false) {
            return null;
        }
        return $this->hydrate($data);
    }

    public function getAllByUserId(int $userId): array|null
    {
        $stmt = $this->connectToDatabase()->prepare("SELECT * FROM orders WHERE user_id = :user_id");
        $stmt->execute(['user_id' => $userId]);
        $data = $stmt->fetchAll();
        if($data === false) {
            return null;
        }
        foreach ($data as &$order) {
            $order = $this->hydrate($order);
        } return $data;
    }


}