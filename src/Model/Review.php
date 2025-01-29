<?php

namespace Model;

class Review extends Model
{
    private int $id;
    private int $productId;
    private int $userId;
    private string $review;
    private int $rating;
    private string $date;
    private Product $product;
    private User $user;

    public function getUser(): User
    {
        return $this->user;
    }

    public function setProductId(int $productId): Review
    {
        $this->productId = $productId;
        return $this;
    }

    public function setUser(User $user): Review
    {
        $this->user = $user;
        return $this;
    }


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


    public function getUserId(): string
    {
        return $this->userId;
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

    public function setUserId(string $userId): Review
    {
        $this->userId = $userId;
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

        $user = new User();
        $user->setId($data['u_id']);
        $user->setName($data['u_name']);
        $user->setEmail($data['u_email']);

        $obj = new Review();
        $obj->id = $data['review_id'];
        $obj->productId = $data['review_product_id'];
        $obj->userId = $data['review_user_id'];
        $obj->review = $data['review_review'];
        $obj->rating = $data['review_rating'];
        $obj->date = $data['review_created_at'];
        $obj->product = $product;
        $obj->user = $user;
        return $obj;
    }

    public static function hydrate(array $data): self
    {
//        $userDb = User::getById()
        $review = new self();
        $review->id = $data['id'];
        $review->productId = $data['product_id'];
        $review->userId = $data['user_id'];
        $review->review = $data['review'];
        $review->rating = $data['rating'];
        $review->date = $data['created_at'];
        return $review;
    }

    public static function createReview(int $productId, int $userId, string $review, int $rating, string $date): void
    {
        $stmt = self::connectToDatabase()->prepare("INSERT INTO reviews (product_id, user_id, review, rating, created_at)
                                                 VALUES (:product_id, :user_id, :review, :rating, :created_at)");
        $stmt->execute(['product_id' => $productId, 'user_id' => $userId, 'review' => $review, 'rating' => $rating, 'created_at' => $date]);
    }


    public static function getReviewsJoinProducts(): array|null
    {
        $stmt = self::connectToDatabase()->prepare("SELECT 
                                                            reviews.id as review_id,
                                                            reviews.product_id as review_product_id,
                                                            reviews.user_id as review_user_id,
                                                            reviews.review as review_review,
                                                            reviews.rating as review_rating,
                                                            reviews.created_at as review_created_at,
                                                            products.id as product_id,
                                                            products.title as product_title,
                                                            products.price as product_price,
                                                            products.description as product_description,
                                                            products.image_link as product_image_link,
                                                            users.id as u_id,
                                                            users.name as u_name,
                                                            users.email as u_email
                                                            FROM reviews 
                                                                JOIN products ON products.id = reviews.product_id
                                                                JOIN users ON users.id = reviews.user_id");
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