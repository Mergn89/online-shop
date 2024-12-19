<?php
namespace Controller;
use Model\Product;
use Model\UserProduct;
//require_once './../Model/UserProduct.php';

class CartController
{
    private UserProduct $userProduct;
    private Product $product;
    public function __construct()
    {
        $this->userProduct = new UserProduct();
        $this->product = new Product();

    }
    public function getCart():void
    {
        session_start();
        if (!isset($_SESSION['user_id'])) {
            header("location: /login");
        } else {

            $userId = $_SESSION['user_id'];

            $allUserProducts = $this->userProduct->getProductsByUserId($userId);

            //$allPrice = $this->totalPrice();

            $productIds = [];

            foreach ($allUserProducts as $userProduct) {
                $productIds[] = $userProduct['product_id']; // $productIds[] = [[0] => 1, [1] =>2]; собираем id продуктов пользователя
            }

            if (count($productIds) > 0) {

                $userProducts = $this->product->getAllByIds($productIds);

                foreach ($allUserProducts as $userProd) {
                    $products = [];
                    foreach ($userProducts as &$product) {
                        if ($userProd['product_id'] === $product['id']) {
                            $product['amount'] = $userProd['amount'];
                        }
                        $products[] = $product;
                    }
                }

                $allPrice = 0;
                foreach ($userProducts as $userProduct) {
                    $total = $userProduct['amount'] * $userProduct['price'];
                    $allPrice += $total;
                }

            }

        }


        require_once './../View/cart.php';
    }




//    public function totalPrice(): int
//    {
//        $userId = $_SESSION['user_id'];
//
//        $allUserProducts = $this->userProduct->getProductsByUserId($userId);
//        $allPrice = 0;
//        foreach ($userProducts as $product) {
//            $total = $product['amount']*$product['price'];
//
//            $allPrice += $total;
//        }
//        return $allPrice;
//    }




}