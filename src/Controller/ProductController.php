<?php
namespace Controller;

use Mergen\Core\AuthServiceInterface;
use Model\Product;
use Model\Review;
use Model\UserProduct;
use Request\ProductRequest;


class ProductController
{
    private AuthServiceInterface $authService;


    public function __construct(AuthServiceInterface $authService)
    {
        $this->authService = $authService;
    }

    public function getCatalog():void
    {
        if (!$this->authService->check()) {
            header("location: /login");
        } else {$userId = $this->authService->getCurrentUser()->getId();
            $products = Product::getProducts();
            $sumAmount = UserProduct::getAmountByUserId($userId);

            require_once "./../View/catalog.php";
        }
    }


    public function getProductAverage(ProductRequest $productRequest): void
    {
        if (!$this->authService->check()) {
            header("location: /login");
        }

        $product = Product::getOneById($productRequest->getProductId());

        $reviews = Review::getReviewsJoinProducts();

        $ratings = [];
        $counts = [];

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
        }

        $allReviews = Review::getReviews();

        require_once "./../View/productAverage.php";

    }

}