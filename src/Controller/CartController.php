<?php
namespace Controller;
use Model\UserProduct;
//require_once './../Model/UserProduct.php';

class CartController
{
    private UserProduct $userProduct;
    public function __construct()
    {
        $this->userProduct = new UserProduct();

    }
    public function getCart():void
    {
        session_start();
        if (!isset($_SESSION['user_id'])) {
            header("location: /login");
        } else {
            $userId = $_SESSION['user_id'];

            $userProducts = $this->userProduct->getProductsByUserId($userId);
            //getUserProductsByUserId($userId);

            $allPrice = $this->totalOrder();

        }
        require_once './../View/cart.php';
    }

    public function totalOrder(): int
    {
        $userId = $_SESSION['user_id'];

        $userProducts = $this->userProduct->getProductsByUserId($userId);

        $allPrice = 0;
        foreach ($userProducts as $product) {
            $total = $product['amount']*$product['price'];

            $allPrice += $total;
        }
        return $allPrice;
    }

}