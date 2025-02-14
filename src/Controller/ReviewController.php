<?php

namespace Controller;

use Mergen\Core\AuthServiceInterface;
use Model\Product;
use Model\Review;
use Request\ReviewRequest;
use Service\OrderService;
use Service\ReviewService;

class ReviewController
{
    private AuthServiceInterface $authService;
    private ReviewService $reviewService;
    private OrderService $orderService;


    public function __construct(ReviewService $reviewService, AuthServiceInterface $authService, OrderService $orderService)
    {
        $this->authService = $authService;
        $this->reviewService = $reviewService;
        $this->orderService = $orderService;
    }


    public function addReview(ReviewRequest $reviewRequest): void
    {
        $userId = $this->authService->getCurrentUser()->getId();
        $productId = $reviewRequest->getProductId();

        $errors = $reviewRequest->validate($userId, $this->orderService, $this->authService);

        $product = Product::getOneById($productId);

        if (empty($errors)) {

            $review = $reviewRequest->getReview();
            $rating = $reviewRequest->getRating();
            date_default_timezone_set('Asia/Irkutsk');
            $date = date('d-m-Y H:i:s');

            $this->reviewService->createReview($productId, $userId, $review, $rating, $date);

            header("location: /reviews");

        }
        require_once "./../View/productAverage.php";
    }


    public function getReviews(): void
    {
        if (!$this->authService->check()) {
            header("location: /login");
        }
        $reviews = Review::getReviewsJoinProducts();

        require_once "./../View/reviews.php";
    }

}