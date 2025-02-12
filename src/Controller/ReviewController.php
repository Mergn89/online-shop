<?php

namespace Controller;

use Core\AuthServiceInterface;
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

//    public function getRev(): void
//    {
//        if (!$this->authService->check()) {
//            header("location: /login");        }
//
////        $product = Product::getOneById($productRequest->getProductId());
//
//        require_once "./../View/review.php";
//
//    }

//    public function getReview(ProductRequest $productRequest): void // попробовать добавить getReviewProduct
//    {
//        if (!$this->authService->check()) {
//            header("location: /login");        }
//
//        $product = Product::getOneById($productRequest->getProductId());
//
//        require_once "./../View/review.php";
//
//    }

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



//        require_once "./../View/productAverage.php";
    }

//    function addRev()
//    {
//        $userId = getOrders();
//        if (isset($userId)) {
//            $productId = getOrderProducts();
//            $review = getReviews();
//            if(isset($productId) && !isset($review)) {
//                $this->addReview();
//            } else {
//                echo 'чтобы оставить отзыв, необходимо заказать продукт';
//            }
//        } else {
//            echo 'чтобы оставить отзыв, необходимо заказать продукт';
//        }
//    }


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
//        $userId = $this->authService->getCurrentUser()->getId();
//        $rev = Review::getReviewsByUserId($userId);
//        foreach ($rev as $value){
//            echo "\n".$value->getUserId();
//        }
//
//        die;
        require_once "./../View/reviews.php";
    }

}