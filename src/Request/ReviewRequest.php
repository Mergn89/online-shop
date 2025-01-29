<?php

namespace Request;

class ReviewRequest extends Request
{
    public function getProductId(): ?int
    {
        return $this->data['product_id'] ?? '';
    }

    public function getUserId(): ?int
    {
        return $this->data['user_name'] ?? '';
    }

    public function getReview(): ?string
    {
        return $this->data['review'] ?? '';
    }

    public function getRating(): ?string
    {
        return $this->data['rating'] ?? '';
    }

    public function validate(): array
    {
        $data = $this->data;
        $errors = [];

//        if (isset($data['user_name'])) {
//            $userName = $data['user_name'];
//            if (empty($userName)) {
//                $errors['user_name'] = 'Имя не должно быть пустым';
//            } elseif (strlen($userName) < 4) {
//                $errors['user_name'] = 'Имя должно содержать не менее 4 символов';
//            } elseif (preg_match("/[^(\w)|(\x7F-\xFF)|(\s)]/", $userName)) {
//                $errors['user_name'] = 'В имени недопустимый символ';
//            }
//        } else {
//            $errors['user_name'] = 'Поле name должно быть заполнено';
//        }

        if (isset($data['review'])) {
            $review = $data['review'];
            if (empty($review)) {
                $errors['review'] = 'Поле  не должно быть пустым или 0';
            }
        } else {
            $errors['review'] = 'Поле должно быть заполнено';
        }


        if (isset($data['rating'])) {
            $rating = $data['rating'];
            if (empty($rating)) {
                $errors['rating'] = 'Поле  не должно быть пустым или 0';
            } elseif ($rating < 1 || $rating > 5) {
                $errors['rating'] = "Некорректное значение";
            } elseif (!preg_match("/^[0-9 ,.-]+$/u", $rating)) {
                $errors['rating'] = "rating может содержать только цифры";
            }

        } else {
            $errors['rating'] = 'Поле должно быть заполнено';
        }

        return $errors;

    }
}