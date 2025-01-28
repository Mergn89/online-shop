<?php
namespace Controller;

use Model\Product;
use Model\Review;
use Model\UserProduct;
use Request\AddProductRequest;
use Request\ProductRequest;
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

    public function getAverageProduct(ProductRequest $productRequest): void
    {
        if (!$this->authService->check()) {
            header("location: /login");
        }

        $product = Product::getOneById($productRequest->getProductId());


        $reviews = Review::getReviewsJoinProducts();
//
//        echo '<pre>';
//        print_r($reviews); die;
//
        $ratings = [];//
//        ['1' = 0, +4, +3..
//         '2' = 0,
//         '3' = 0
//        ];

        $counts = [];
//        ['1' = 0, +1, +1...
//         '2' = 0,....
//         '3' = 0.....
//        ];
        foreach ($reviews as $row) {
            $productId = $row->getProductId();
            $rating = $row->getRating();
            if(!isset($ratings[$productId])) {
                $ratings[$productId] = 0;
                $counts[$productId] = 0;
            }
            $ratings[$productId] += $rating;
            $counts[$productId] += 1;

        }
        $averageRatings = [];
        foreach ($ratings as $productId => $totalRating) {

            $averageRatings[$productId] = $totalRating / $counts[$productId];
//            $averageProduct = $averageRatings
//            if($averageRatings[$productId] === $product->getId()) {
//                $avg = $
//            }
        }


//        echo '<pre>';
//        print_r($averageRatings[$product->getId()]);
//        echo '</pre>'; die;



        require_once "./../View/product.php";
//        if (!$this->authService->check()) {
//            header("location: /login");
//        }
//
//        $product = Product::getOneById($productRequest->getProductId());
//
////        print_r($product);die;

//        require_once "./../View/review.php";

    }





}