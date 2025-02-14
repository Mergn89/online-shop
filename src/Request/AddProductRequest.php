<?php

namespace Request;

use Mergen\Core\Request;
use Model\Product;


class AddProductRequest extends Request
{
    public function getProductId(): ?int
    {
        return $this->data['product_id'] ?? '';
    }

    public function getAmount(): ?int
    {
        return $this->data['amount'] ?? '';
    }

    public function validate(): array
    {
        $data = $this->data;
        $errors = [];

        if (isset($data['product_id'])) {
            $productId = $data['product_id'];
            if (empty($productId)) {
                $errors['product_id'] = 'Поле не должно быть пустым или 0';
            } elseif (!ctype_digit($productId)) {
                $errors['product_id'] = 'Неправильный id продукта';

            } else {
                $product = Product::getOneById($productId);
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