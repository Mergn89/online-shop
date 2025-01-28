<?php

namespace Model;

class Review extends Model
{
    private int $id;
    private int $productId;
    private string $userName;
    private string $review;
    private int $rating;
    private string $date;
    private Product $product;


    public function getProductId(): int
    {
        return $this->productId;
    }


    public function getDate(): string
    {
        return $this->date;
    }

    public function getProduct(): Product
    {
        return $this->product;
    }

    public function setDate(string $date): Review
    {
        $this->date = $date;
        return $this;
    }

    public function setProduct(Product $product): Review
    {
        $this->product = $product;
        return $this;
    }


//    public function __construct()
//    {
////        $this->product = new Product();
//    }



    public function getId(): int
    {
        return $this->id;
    }


    public function getUserName(): string
    {
        return $this->userName;
    }

    public function getReview(): string
    {
        return $this->review;
    }

    public function getRating(): int
    {
        return $this->rating;
    }

    public function getCreated(): string
    {
        return $this->date;
    }

    public function setId(int $id): Review
    {
        $this->id = $id;
        return $this;
    }

    public function setUserName(string $userName): Review
    {
        $this->userName = $userName;
        return $this;
    }

    public function setReview(string $review): Review
    {
        $this->review = $review;
        return $this;
    }

    public function setRating(int $rating): Review
    {
        $this->rating = $rating;
        return $this;
    }

    public function setCreated(string $date): Review
    {
        $this->date = $date;
        return $this;
    }

    public static function hydrateJoin(array $data): self
    {
        $product = new Product();
        $product->setId($data['product_id']);
        $product->setTitle($data['product_title']);
        $product->setDescription($data['product_description']);
        $product->setPrice($data['product_price']);
        $product->setImageLink($data['product_image_link']);

        $obj = new Review();
        $obj->id = $data['review_id'];
        $obj->productId = $data['review_product_id'];
        $obj->userName = $data['review_user_name'];
        $obj->review = $data['review_review'];
        $obj->rating = $data['review_rating'];
        $obj->date = $data['review_created_at'];
        $obj->product = $product;
        return $obj;
    }

    public static function hydrate(array $data): self    {

        $review = new self();
        $review->id = $data['id'];
        $review->productId = $data['product_id'];
        $review->userName = $data['user_name'];
        $review->review = $data['review'];
        $review->rating = $data['rating'];
        $review->date = $data['created_at'];
        return $review;
    }

    public static function createReview(int $productId, string $userName, string $review, int $rating, string $date): void
    {
        $stmt = self::connectToDatabase()->prepare("INSERT INTO reviews (product_id, user_name, review, rating, created_at)
                                                 VALUES (:product_id, :user_name, :review, :rating, :created_at)");
        $stmt->execute(['product_id' => $productId, 'user_name' => $userName, 'review' => $review, 'rating' => $rating, 'created_at' => $date]);
    }


    public static function getReviewsJoinProducts(): array|null
    {
        $stmt = self::connectToDatabase()->prepare("SELECT 
                                                            reviews.id as review_id,
                                                            reviews.product_id as review_product_id,
                                                            reviews.user_name as review_user_name,
                                                            reviews.review as review_review,
                                                            reviews.rating as review_rating,
                                                            reviews.created_at as review_created_at,
                                                            products.id as product_id,
                                                            products.title as product_title,
                                                            products.price as product_price,
                                                            products.description as product_description,
                                                            products.image_link as product_image_link            
                                                            FROM reviews JOIN products ON products.id = reviews.product_id ");
        $stmt->execute();
        $data = $stmt->fetchAll();
        if($data === false){
            return null;
        } else{
            foreach ($data as &$datum){
                $datum = self::hydrateJoin($datum);
            }
        } return $data;

    }


//    public static function getAverageRating(): array|null
//    {
//        $stmt = self::connectToDatabase()->prepare("SELECT
//                                                            products.id as product_id,
//                                                            products.title as product_title,
//                                                            products.price as product_price,
//                                                            products.description as product_description,
//                                                            products.image_link as product_image_link,
//                                                            reviews.id as review_id,
//                                                            reviews.product_id as review_product_id,
//                                                            reviews.user_name as review_user_name,
//                                                            reviews.review as review_review,
//                                                            reviews.rating as review_rating,
//                                                            reviews.created_at as review_created_at,
//
//                                                            AVG(reviews.rating) as average_rating
//                                                            FROM reviews  INNER JOIN products  ON products.id = reviews.product_id
//                                                            GROUP BY products.id, products.title
//                                                            ");
//
//
//        $stmt->execute();
//        $data = $stmt->fetchAll();
//        if ($data === false) {
//            return null;
//        }
//        foreach ($data as &$datum) {
//            $datum = self::hydrateJoin($datum);
//        }
//        return $data;
//    }


    public static function getReviews(): array|null
    {
        $stmt = self::connectToDatabase()->prepare("SELECT * FROM reviews"
        );
        $stmt->execute();
        $data = $stmt->fetchAll();
        if($data === false){
            return null;
        } else{
            foreach ($data as &$datum){
                $datum = self::hydrate($datum);
            }
        } return $data;

    }


}