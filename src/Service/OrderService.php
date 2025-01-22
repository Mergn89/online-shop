<?php

namespace Service;
use Model\Model;
use Model\Order;
use Model\OrderProduct;
use Model\Product;
use Model\UserProduct;
use DTO\CreateOrderDTO;


class OrderService
{
    public function create(CreateOrderDTO $orderDTO): void
    {
        $total = $this->getTotal($this->getAllUserProducts($orderDTO), $this->getUserProducts($this->getAllUserProducts($orderDTO)));

        $pdo = Model::connectToDatabase();
        $pdo->beginTransaction();
        try{
            Order::createOrder($orderDTO->getUserId(), $orderDTO->getContactName(), $orderDTO->getAddress(), $orderDTO->getPhone(), $total);

            $orderUser = Order::getOrderByUserId($orderDTO->getUserId());
//            throw new \PDOException('error connect to base'); //проверка транзакционности(не должен сохранять в orders;
            foreach ($this->getUserProducts($this->getAllUserProducts($orderDTO)) as $product) {
                OrderProduct::addProductInOrder($orderUser->getId(), $product->getId(), $product->getAmount(), $product->getPrice());
            }
            UserProduct::deleteProductByUserId($orderDTO->getUserId());

        } catch (\PDOException $exception){
            $pdo->rollBack();
            throw $exception;
        }
        $pdo->commit();

    }

    private function getAllUserProducts(CreateOrderDTO $orderDTO): array
    {
        $allUserProducts = UserProduct::getUserProductsByUserId($orderDTO->getUserId());

        return $allUserProducts;
    }

    private function getUserProducts(array $allUserProducts): array
    {
        $userProducts = [];
        if (!empty($allUserProducts)) {
            $productIds = [];

            foreach ($allUserProducts as $userProduct) {
                $productIds[] = $userProduct->getProductId(); // $productIds[] = [[0] => 1, [1] =>2]; собираем id продуктов пользователя
            }
            $userProducts = Product::getAllByIds($productIds);
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