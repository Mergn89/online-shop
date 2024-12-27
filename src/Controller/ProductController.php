<?php
namespace Controller;

use Model\Product;
use Model\UserProduct;

//require_once './../Model/Products.php';
//require_once './../Model/UserProduct.php';

class ProductController
{
    private Product $product;
//    private UserProduct $userProduct;

    public function __construct()
    {
        $this->product = new Product();
//        $this->userProduct = new UserProduct();
    }

    public function getCatalog():void
    {
        session_start();
        if (!isset($_SESSION['user_id'])) {
            header("location: /login");
        }
        $products = $this->product->getProducts();

        require_once "./../View/catalog.php";
    }



}