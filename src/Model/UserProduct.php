<?php

class UserProduct
{
    public function getAmountByUserProducts(int $userId, int $productId): array|false
    {
        $pdo = new PDO("pgsql:host=postgres; port=5432; dbname=mydb", 'user', 'pass');
        $stmt = $pdo->prepare("SELECT amount FROM user_products WHERE user_id = :user_id and product_id = :product_id");
        $stmt->execute(['user_id' => $userId, 'product_id' => $productId]);
        return$stmt->fetch();
    }

    public function addProductInUserProducts(int $userId, int $productId, int $amount): void
    {
        $pdo = new PDO("pgsql:host=postgres; port=5432; dbname=mydb", 'user', 'pass');
        $stmt = $pdo->prepare("INSERT INTO user_products (user_id, product_id, amount) VALUES (:user_id, :product_id, :amount)");
        $stmt->execute(['user_id' => $userId, 'product_id' => $productId, 'amount' => $amount]);

    }

    public function updateAmountInUserProducts(int $sumAmount, int $userId, int $productId): void
    {
        $pdo = new PDO("pgsql:host=postgres; port=5432; dbname=mydb", 'user', 'pass');
        $stmt = $pdo->prepare("UPDATE user_products SET amount = :amount WHERE user_id = :user_id AND product_id = :product_id");
        $stmt->execute(['amount' => $sumAmount, 'user_id' => $userId, 'product_id' => $productId]);

    }

    public function getUserProductsByUserId(int $userId): array|false
    {
        $pdo = new PDO("pgsql:host=postgres; port=5432; dbname=mydb", 'user', 'pass');
        $stmt = $pdo->prepare("SELECT products.id AS product_id,
                                    products.name AS product_name,
                                    products.description AS product_description,
                                    products.price AS product_price,
                                    products.image_link AS product_image_link,
                                    user_products.amount AS user_products_amount 
                                    FROM user_products INNER JOIN products ON products.id = user_products.product_id WHERE user_id = :user_id"
        );
        $stmt->execute(['user_id' => $userId]);
        return$stmt->fetchAll();
    }

    public function getProductsByUserId(int $userId): array
    {
        $pdo = new PDO("pgsql:host=postgres; port=5432; dbname=mydb", 'user', 'pass');
        $stmt = $pdo->prepare("SELECT * FROM user_products JOIN products ON user_products.product_id = products.id WHERE user_id = :user_id");
        $stmt->execute(['user_id' => $userId]);
        return $stmt->fetchAll();

    }

    public function deleteProductByUserId(int $userId):void
    {
        $pdo = new PDO("pgsql:host=postgres; port=5432; dbname=mydb", 'user', 'pass');
        $stmt = $pdo->prepare("DELETE FROM user_products WHERE user_id = :user_id");
        $stmt->execute(['user_id' => $userId]);

    }



}