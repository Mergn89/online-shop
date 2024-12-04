<?php
require_once './../Model/UserProduct.php';

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

            $userProducts = $this->userProduct->getUserProductsByUserId($userId);

            $allPrice = 0;
            foreach ($userProducts as $product) {
                $total = $product['user_products_amount']*$product['product_price'];
                $allPrice += $total;
            }
        }
        require_once './../View/cart.php';
    }

}