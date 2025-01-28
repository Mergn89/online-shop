<?php

namespace Controller;

use Model\Product;
use Model\Review;
use Request\ProductRequest;
use Request\ReviewRequest;
use Service\Auth\AuthServiceInterface;
use Service\ReviewService;

class ReviewController
{
    private AuthServiceInterface $authService;
    private ReviewService $reviewService;

    public function __construct(AuthServiceInterface $authService)
    {
        $this->authService = $authService;
        $this->reviewService = new ReviewService();


    }
    public function getReview(ProductRequest $productRequest): void // попробовать добавить getReviewProduct
    {
        if (!$this->authService->check()) {
            header("location: /login");
        }

        $product = Product::getOneById($productRequest->getProductId());

//
        require_once "./../View/review.php";

    }

    public function addReview(ReviewRequest $reviewRequest): void
    {
        $errors = $reviewRequest->validate();

        if (empty($errors)) {
            $productId = $reviewRequest->getProductId();
            $userName = $reviewRequest->getUserName();
            $review = $reviewRequest->getReview();
            $rating = $reviewRequest->getRating();
            date_default_timezone_set('Asia/Irkutsk');
            $date = date('d-m-Y H:i:s');


            $this->reviewService->createReview($productId, $userName, $review, $rating, $date);
            header("location: /reviews");
        }
    }

    public function getReviews(): void
    {
        if (!$this->authService->check()) {
            header("location: /login");
        }
        $reviews = Review::getReviewsJoinProducts();
//        $average = Review::getAverageRating();
//
//        print_r($average); die;
//
//
//        echo '<pre>';
//        print_r($averageRatings);
//        echo '</pre>'; die;
//        print_r($avg);die;

        require_once "./../View/reviews.php";
    }

}