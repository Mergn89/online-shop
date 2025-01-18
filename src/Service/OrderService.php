<?php

namespace Service;
use Model\Model;
use Model\Order;
use Model\OrderProduct;
use Model\Product;
use Model\UserProduct;
use DTO\CreateOrderDTO;
use mysql_xdevapi\Exception;

class OrderService
{
//    private Model $model;
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
//        $this->model = new Model();
    }

    public function create(CreateOrderDTO $orderDTO): void
    {
        $total = $this->getTotal($this->getAllUserProducts($orderDTO), $this->getUserProducts($this->getAllUserProducts($orderDTO)));

        $pdo = Model::connectToDatabase();
        $pdo->beginTransaction();
        try{
            $this->order->createOrder($orderDTO->getUserId(), $orderDTO->getContactName(), $orderDTO->getAddress(), $orderDTO->getPhone(), $total);

            $orderUser = $this->order->getOrderByUserId($orderDTO->getUserId());
//            throw new \PDOException('error connect to base'); //проверка транзакционности(не должен сохранять в orders;
            foreach ($this->getUserProducts($this->getAllUserProducts($orderDTO)) as $product) {
                $this->orderProduct->addProductInOrder($orderUser->getId(), $product->getId(), $product->getAmount(), $product->getPrice());
            }
            $this->userProduct->deleteProductByUserId($orderDTO->getUserId());

        } catch (\PDOException $exception){
            $pdo->rollBack();
            throw $exception;
        }
        $pdo->commit();

    }

    private function getAllUserProducts(CreateOrderDTO $orderDTO): array
    {
        $allUserProducts = $this->userProduct->getUserProductsByUserId($orderDTO->getUserId());

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