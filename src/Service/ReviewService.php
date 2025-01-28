<?php

namespace Service;

use Model\Review;


class ReviewService
{
    public function createReview(int $productId, string $userName, string $review, int $rating, string $date): void
    {
        Review::createReview($productId, $userName, $review, $rating, $date);

    }

}