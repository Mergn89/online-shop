<?php

namespace Service;

use Model\Review;


class ReviewService
{
    public function createReview(int $productId, int $userId, string $review, int $rating, string $date): void
    {
        Review::createReview($productId, $userId, $review, $rating, $date);

    }

}