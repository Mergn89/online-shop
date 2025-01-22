<?php
namespace Controller;

use Model\Product;
use Model\UserProduct;
use Service\Auth\AuthServiceInterface;


class ProductController
{
    private AuthServiceInterface $authService;


    public function __construct(AuthServiceInterface $authService)
    {
        $this->authService = $authService;

    }

    public function getCatalog():void
    {
//        session_start();
        if (!$this->authService->check()) {
            header("location: /login");
        }
        $products = Product::getProducts();

        require_once "./../View/catalog.php";
    }



}