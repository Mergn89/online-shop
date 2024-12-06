<?php
require_once './../Model/Database.php';
class UserProduct extends Database
{
    public function getAmountByUserProducts(int $userId, int $productId): array|false
    {
        $stmt = $this->connectToDatabase()->prepare("SELECT amount FROM user_products WHERE user_id = :user_id and product_id = :product_id");
        $stmt->execute(['user_id' => $userId, 'product_id' => $productId]);
        return $stmt->fetch();
    }

    public function addProductInUserProducts(int $userId, int $productId, int $amount): void
    {
        $stmt = $this->connectToDatabase()->prepare("INSERT INTO user_products (user_id, product_id, amount) VALUES (:user_id, :product_id, :amount)");
        $stmt->execute(['user_id' => $userId, 'product_id' => $productId, 'amount' => $amount]);

    }

    public function updateAmountInUserProducts(int $sumAmount, int $userId, int $productId): void
    {
        $stmt = $this->connectToDatabase()->prepare("UPDATE user_products SET amount = :amount WHERE user_id = :user_id AND product_id = :product_id");
        $stmt->execute(['amount' => $sumAmount, 'user_id' => $userId, 'product_id' => $productId]);

    }

/*    public function getUserProductsByUserId(int $userId): array|false
    {

        $stmt = $this->pdo->connectToDatabase()->prepare("SELECT products.id AS product_id,
                                    products.name AS product_name,
                                    products.description AS product_description,
                                    products.price AS product_price,
                                    products.image_link AS product_image_link,
                                    user_products.amount AS user_products_amount 
                                    FROM user_products INNER JOIN products ON products.id = user_products.product_id WHERE user_id = :user_id"
        );
        $stmt->execute(['user_id' => $userId]);
        return $stmt->fetchAll();
    }
*/
    public function getProductsByUserId(int $userId): array
    {
        $stmt = $this->connectToDatabase()->prepare("SELECT * FROM user_products 
                                                                JOIN products ON user_products.product_id = products.id WHERE user_id = :user_id");
        $stmt->execute(['user_id' => $userId]);
        return $stmt->fetchAll();

    }

    public function deleteProductByUserId(int $userId):void
    {
        $stmt = $this->connectToDatabase()->prepare("DELETE FROM user_products WHERE user_id = :user_id");
        $stmt->execute(['user_id' => $userId]);

    }



}