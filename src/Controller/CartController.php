<?php
require_once './../Model/UserProduct.php';

class CartController
{
    public function getCart():void
    {
        session_start();
        if (!isset($_SESSION['user_id'])) {
            header("location: /login");
        } else {
            $userId = $_SESSION['user_id'];

            $dataUserProducts = new UserProduct();
            $userProducts = $dataUserProducts->getUserProductsByUserId($userId);

            $allPrice = 0;
            foreach ($userProducts as $product) {
                $total = $product['user_products_amount']*$product['product_price'];
                $allPrice += $total;
            }
        }
        require_once './../View/cart.php';
    }

}