<?php
namespace Model;

class OrderProduct extends Model
{
    private int $id;
    private int $orderId;
    private int $productId;
    private int $amount;
    private int $orderPrice;

    public function getId(): int
    {
        return $this->id;
    }

    public function getOrderId(): int
    {
        return $this->orderId;
    }

    public function getProductId(): int
    {
        return $this->productId;
    }

    public function getAmount(): int
    {
        return $this->amount;
    }

    public function getOrderPrice(): int
    {
        return $this->orderPrice;
    }

    public function setId(int $id): OrderProduct
    {
        $this->id = $id;
        return $this;
    }

    public function setOrderId(int $orderId): OrderProduct
    {
        $this->orderId = $orderId;
        return $this;
    }

    public function setProductId(int $productId): OrderProduct
    {
        $this->productId = $productId;
        return $this;
    }

    public function setAmount(int $amount): OrderProduct
    {
        $this->amount = $amount;
        return $this;
    }

    public function setOrderPrice(int $orderPrice): OrderProduct
    {
        $this->orderPrice = $orderPrice;
        return $this;
    }

    public static function hydrate(array $data): self
    {
        $orderProduct = new OrderProduct();
        $orderProduct->id = $data['id'];
        $orderProduct->orderId = $data['order_id'];
        $orderProduct->productId = $data['product_id'];
        $orderProduct->amount = $data['amount'];
        $orderProduct->orderPrice = $data['order_price'];
        return $orderProduct;
    }

    public static function addProductInOrder(int $orderId, int $productId, int $amount, int $orderPrice): void
    {
        $stmt = Model::connectToDatabase()->prepare("INSERT INTO order_products (order_id, product_id, amount, order_price) 
                                                  VALUES (:order_id, :product_id, :amount, :order_price)");
        $stmt->execute(['order_id' => $orderId, 'product_id' => $productId, 'amount' => $amount, 'order_price' => $orderPrice]);
    }

    public static function getByOrderId(int $orderId): array|null
    {
        $stmt = self::connectToDatabase()->prepare("SELECT * FROM order_products WHERE order_id = :order_id");
        $stmt->execute(['order_id' => $orderId]);
        $data = $stmt->fetchAll();
        if ($data === false) {
            return null;
        }
        foreach ($data as &$orderProduct) {
            $orderProduct = self::hydrate($orderProduct);
        } return $data;
    }



}