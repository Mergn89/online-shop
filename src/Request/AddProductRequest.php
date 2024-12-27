<?php

namespace Request;

use Model\Product;

class AddProductRequest extends Request
{
    private Product $product;
    public function __construct(string $uri, string $method, array $data = [])
    {
        parent::__construct($uri, $method, $data);
        $this->product = new Product();
    }
    public function getProductId(): ?string
    {
        return $this->data['product_id'] ?? '';
    }
    public function getAmount(): ?string
    {
        return $this->data['amount'] ?? '';
    }

    public function validate(): array
    {
        $data = $this->data;
        $errors = [];
//        session_start();
//        if (isset($_SESSION['user_id'])) {
//            $userId = $_SESSION['user_id'];
//            if (empty($userId)) {
//                $errors['user_id'] = 'Пожалуйста, авторизируйтесь';
//            }
//        } else {
//            $errors['user_id'] = 'Пожалуйста, авторизируйтесь';
//        }
        if (isset($data['product_id'])) {
            $productId = $data['product_id'];
            if (empty($productId)) {
                $errors['product_id'] = 'Поле не должно быть пустым или 0';
            } elseif (!ctype_digit($productId)) {
                $errors['product_id'] = 'Неправильный id продукта';

            } else {
                $product = $this->product->getOneById($productId);
                if (!$product) {
                    $errors['product_id'] = 'Продукт не существует';
                }
            }
        } else {
            $errors['product_id'] = 'Поле должно быть заполнено';
        }

        if (isset($data['amount'])) {
            $amount = $data['amount'];
            if (empty($amount)) {
                $errors['amount'] = 'Поле  не должно быть пустым или 0';
            } elseif (!ctype_digit($amount)) {
                $errors['amount'] = 'Некорректное значение';
            }
        } else {
            $errors['amount'] = 'Поле должно быть заполнено';
        }
        return $errors;
    }

}