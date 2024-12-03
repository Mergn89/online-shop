<?php
require_once './../Model/Order.php';
require_once './../Model/UserProduct.php';
require_once './../Model/OrderProduct.php';

class OrderController
{
    public function getOrderForm(): void
    {
        session_start();
        $userId = $_SESSION['user_id'];

        if (!isset($_SESSION['user_id'])) {
            header('Location: /login');
        }
        $userProduct = new UserProduct();
        $res = $userProduct->getProductsByUserId($userId);

        require_once "./../View/order.php";
    }

    public function getOrder(): void
    {
        $errors = $this->validateOrder($_POST);

        if (empty($errors)) {
            session_start();
            $userId = $_SESSION['user_id'];
            $contactName = $_POST['contact_name'];
            $address = $_POST['address'];
            $phone = $_POST['phone'];

            $order = new Order();
            $order->createOrder($userId, $contactName, $address, $phone);

            $orderUser = $order->getOrderByUserId($userId);

            $userProduct = new UserProduct();
            $orderProduct = new OrderProduct();
            foreach ($userProduct->getProductsByUserId($userId) as $product) {
                $orderProduct->addProductInOrder($orderUser['id'], $product['product_id'], $product['amount'], $product['price']);
            }
            $userProduct->deleteProductByUserId($userId);
            header('Location: /order');

        } else {
            require_once "./../View/order.php";
        }
    }

    private function validateOrder(array $post): array
    {
        $errors = [];

        if (isset($post['contact_name'])) {
            $contactName = ($post['contact_name']);
            if (strlen($contactName) < 3 || strlen($contactName) > 20) {
                $errors['contact_name'] = "Имя должно содержать не меньше 3 символов и не больше 20 символов";
            } elseif (!preg_match("/^[a-zA-Zа-яА-Я]+$/u", $contactName)) {
                $errors['contact_name'] = "Имя может содержать только буквы";
            }
        } else {
            $errors ['contact_name'] = "Поле должно быть заполнено";
        }

        if (isset($post['address'])) {
            $address = ($post['address']);
            if (strlen($address) < 3 || strlen($address) > 100) {
                $errors['address'] = "Адресс должен содержать не меньше 3 символов и не больше 100 символов";
            } elseif (!preg_match("/^[a-zA-Zа-яА-Я0-9 ,.-]+$/u", $address)) {
                $errors['address'] = "Адресс может содержать только буквы и цифры";
            }
        } else {
            $errors ['address'] = "Поле address должно быть заполнено";
        }

        if (isset($post['phone'])) {
            $phone = ($post['phone']);
            if (!preg_match("/^[0-9]+$/u", $phone)) {
                $errors['phone'] = "Номер телефона может содержать только цифры";
            } elseif (strlen($phone) < 3 || strlen($phone) > 15) {
                $errors['phone'] = "Номер телефона должен содержать не меньше 3 символов и не больше 15 символов";
            }
        } else {
            $errors ['phone'] = "Поле phone должно быть заполнено";
        }
        return $errors;
    }


}