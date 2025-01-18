<?php
namespace Model;

class UserProduct extends Model
{
    private int $id;
    private int $user_id;
    private int $product_id;
    private int $amount;


    public function getId(): int
    {
        return $this->id;
    }

    public function getUserId(): int
    {
        return $this->user_id;
    }

    public function getProductId(): int
    {
        return $this->product_id;
    }

    public function getAmount(): int
    {
        return $this->amount;
    }

    public function setId(int $id): UserProduct
    {
        $this->id = $id;
        return $this;
    }

    public function setUserId(int $user_id): UserProduct
    {
        $this->user_id = $user_id;
        return $this;
    }

    public function setProductId(int $product_id): UserProduct
    {
        $this->product_id = $product_id;
        return $this;
    }

    public function setAmount(int $amount): UserProduct
    {
        $this->amount = $amount;
        return $this;
    }

    public static function hydrate(array $data): self
    {
        $userProduct = new self();
        $userProduct->id = $data['id'];
        $userProduct->user_id = $data['user_id'];
        $userProduct->product_id = $data['product_id'];
        $userProduct->amount = $data['amount'];
        return $userProduct;

    }
    public static function getAmountByUserIdAndProductId(int $userId, int $productId): self|null
    {
        $stmt = Model::connectToDatabase()->prepare("SELECT * FROM user_products WHERE user_id = :user_id and product_id = :product_id");
        $stmt->execute(['user_id' => $userId, 'product_id' => $productId]);
        $data = $stmt->fetch();
        if($data === false){
            return null;
        }
        return self::hydrate($data);
    }

    public function addProductInUserProducts(int $userId, int $productId, int $amount): void
    {
        $stmt = self::connectToDatabase()->prepare("INSERT INTO user_products (user_id, product_id, amount) VALUES (:user_id, :product_id, :amount)");
        $stmt->execute(['user_id' => $userId, 'product_id' => $productId, 'amount' => $amount]);

    }

    public function updateAmountInUserProducts(int $userId, int $productId, int $sumAmount): void
    {
        $stmt = self::connectToDatabase()->prepare("UPDATE user_products SET amount = :amount WHERE user_id = :user_id AND product_id = :product_id");
        $stmt->execute(['user_id' => $userId, 'product_id' => $productId, 'amount' => $sumAmount]);

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
//    public function getProductsByUserId(int $userId): array
//    {
//        $stmt = $this->connectToDatabase()->prepare("SELECT * FROM user_products
//                                                           JOIN products ON user_products.product_id = products.id WHERE user_id = :user_id");
//        $stmt->execute(['user_id' => $userId]);
//        return $stmt->fetchAll();
//
//
    public static function getUserProductsByUserId(int $userId): array|null
    {
        $stmt = self::connectToDatabase()->prepare("SELECT * FROM user_products WHERE user_id = :user_id");
        $stmt->execute(['user_id' => $userId]);
        $data = $stmt->fetchAll();// возвращает примерно массив => $arr = [['product_id'] => 1, ['amount' => 5],['product_id'] => 2, ['amount'] => 6]];
        if($data === false) {
            return null;
        }
        foreach ($data as &$userProduct) {
            $userProduct = self::hydrate($userProduct);
        }
        return $data;
    }

    public function deleteProductByUserId(int $userId):void
    {
        $stmt = self::connectToDatabase()->prepare("DELETE FROM user_products WHERE user_id = :user_id");
        $stmt->execute(['user_id' => $userId]);

    }



}