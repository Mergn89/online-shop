<?php

namespace Request;

use Mergen\Core\AuthServiceInterface;
use Mergen\Core\Request;
use Model\Review;
use Service\OrderService;

class ReviewRequest extends Request
{
    public function getProductId(): ?int
    {
        return $this->data['product_id'] ?? '';
    }

    public function getReview(): ?string
    {
        return $this->data['review'] ?? '';
    }

    public function getRating(): ?string
    {
        return $this->data['rating'] ?? '';
    }


    public function validate(int $userId, OrderService $orderService, AuthServiceInterface $authService): array
    {
        $data = $this->data;
        $errors = [];

        if (isset($data['review'])) {
            $review = $data['review'];
            if (empty($review)) {
                $errors['review'] = 'Поле не должно быть пустым';

            }
        } else {
            $errors['review'] = 'Поле должно быть заполнено';
        }


        if (isset($data['rating'])) {
            $rating = $data['rating'];
            if (empty($rating)) {
                $errors['rating'] = 'оцените товар, пожалуйста';
            } elseif ($rating < 1 || $rating > 5) {
                $errors['rating'] = "Некорректное значение";
            } elseif (!preg_match("/^[0-9 ,.-]+$/u", $rating)) {
                $errors['rating'] = "rating может содержать только цифры";
            }

        } else {
            $errors['rating'] = 'Поле должно быть заполнено';
        }

        if (isset($data['product_id'])) {
            $productId = (int) $data['product_id'];

            $orders = $orderService->getOrders($userId);

            $flag = false;
            foreach ($orders as $order) {
                foreach ($order->getProducts() as $product){
                    if($product->getId() === $productId) {
                        $flag = true;
                    }
                }
            }

            if (!$flag) {
                $errors['product_id'] = 'чтобы оставить отзыв, закажите продукт';
            }

            $userId = $authService->getCurrentUser()->getId();
            $rev = Review::getReviewsByUserId($userId);
            foreach ($rev as $review) {
                if($flag && $review->getProductId() === $productId ) {
                    $errors['product_id'] = 'Вы уже оставляли отзыв по этому товару';
                }
            }
        }
        return $errors;

    }
}