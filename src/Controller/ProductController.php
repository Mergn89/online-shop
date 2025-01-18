<?php
namespace Controller;

use Model\Product;
use Model\UserProduct;
use Service\AuthService;

//require_once './../Model/Products.php';
//require_once './../Model/UserProduct.php';

class ProductController
{
    private AuthService $authService;
    private Product $product;
//    private UserProduct $userProduct;

    public function __construct()
    {
        $this->authService = new AuthService();
        $this->product = new Product();
//        $this->userProduct = new UserProduct();
    }

    public function getCatalog():void
    {
//        session_start();
        if (!$this->authService->check()) {
            header("location: /login");
        }
        $products = $this->product->getProducts();

        require_once "./../View/catalog.php";
    }



}