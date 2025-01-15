<?php

namespace Service;
use Model\Order;
use Model\OrderProduct;
use Model\Product;
use Model\UserProduct;
use DTO\CreateOrderDTO;

class OrderService
{
    private Order $order;
    private OrderProduct $orderProduct;
    private UserProduct $userProduct;
    private Product $products;


    public function __construct()
    {
        $this->order = new Order();
        $this->orderProduct = new OrderProduct();
        $this->userProduct = new UserProduct();
        $this->products = new Product();

    }

    public function create(CreateOrderDTO $orderDTO): void
    {
        $total = $this->getTotal($this->getAllUserProducts(), $this->getUserProducts($this->getAllUserProducts()));

        $this->order->createOrder($orderDTO->getUserId(), $orderDTO->getContactName(), $orderDTO->getAddress(), $orderDTO->getPhone(), $total);

        $orderUser = $this->order->getOrderByUserId($orderDTO->getUserId());

        foreach ($this->getUserProducts($this->getAllUserProducts()) as $product) {
            $this->orderProduct->addProductInOrder($orderUser->getId(), $product->getId(), $product->getAmount(), $product->getPrice());
        }
        $this->userProduct->deleteProductByUserId($orderDTO->getUserId());

    }

    public function getAllUserProducts(): array
    {
        $userId = $_SESSION['user_id'];
        $allUserProducts = $this->userProduct->getUserProductsByUserId($userId);

        return $allUserProducts;
    }

    public function getUserProducts(array $allUserProducts): array
    {
        $userProducts = [];
        if (!empty($allUserProducts)) {
            $productIds = [];

            foreach ($allUserProducts as $userProduct) {
                $productIds[] = $userProduct->getProductId(); // $productIds[] = [[0] => 1, [1] =>2]; собираем id продуктов пользователя
            }
            $userProducts = $this->products->getAllByIds($productIds);
            foreach ($allUserProducts as $userProduct) {
                foreach ($userProducts as $product) {
                    if ($userProduct->getProductId() === $product->getId()) {
                        $product->setAmount($userProduct->getAmount());
                    }
                }
            }
        }
        return $userProducts;
    }

    public function getTotal(array $allUserProducts, array $userProducts): int
    {
        $total = 0;
        foreach ($allUserProducts as $userProduct) {
            foreach ($userProducts as $product) {
                if ($userProduct->getProductId() === $product->getId()) {
                    //$product->setAmount($userProduct->getAmount());
                    $allPrice = $userProduct->getAmount() * $product->getPrice();
                    $total += $allPrice;
                }
            }
        }
        return $total;
    }


}