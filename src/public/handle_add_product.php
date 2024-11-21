<?php
function productValidate(array $post): array
{
    $errors = [];
    session_start();
    if (isset($_SESSION['user_id'])) {
        $userId = $_SESSION['user_id'];
        if (empty($userId)) {
            $errors['user_id'] = 'Пожалуйста, авторизируйтесь';
        }
    } else {
        $errors['user_id'] = 'Пожалуйста, авторизируйтесь';
    }
    if (isset($post['product_id'])) {
        $productId = $post['product_id'];
        if (empty($productId)) {
            $errors['product_id'] = 'Поле не должно быть пустым';
        } elseif (!ctype_digit($productId)) {
            $errors['product_id'] = 'Неправильный id продукта';

        } else {

            $pdo = new PDO("pgsql:host=postgres; port=5432; dbname=mydb", 'user', 'pass');
            $stmt = $pdo->query("SELECT * FROM products WHERE id = '$productId'");
            $res = $stmt->fetch();
            if ($res === false) {
                $errors['product_id'] = 'Продукт не существует';
            }
        }
    } else {
        $errors['product_id'] = 'Поле должно быть заполнено';
    }

    if (isset($post['amount'])) {
        $amount = $post['amount'];
        if (empty($amount)) {
            $errors['amount'] = 'Поле  не должно быть пустым';
        } elseif (!ctype_digit($amount)) {
            $errors['amount'] = 'Некорректное значение';
        }
    } else {
        $errors['amount'] = 'Поле должно быть заполнено';
    }
    return $errors;
}

$errors = productValidate($_POST);

if (empty($errors)) {
    $productId = $_POST['product_id'];
    $amount = $_POST['amount'];
    //session_start(); сессия уже запущена выше
    $userId = $_SESSION['user_id'];

    $pdo = new PDO("pgsql:host=postgres; port=5432; dbname=mydb", 'user', 'pass');
    $stmt = $pdo->prepare("SELECT amount FROM user_products WHERE user_id = :user_id and product_id = :product_id");
    $stmt->execute(['user_id' => $userId, 'product_id' => $productId]);
    $dataUserProducts = $stmt->fetch();

    if ($dataUserProducts) {
        $sumAmount = $dataUserProducts['amount'] + $amount;

        $pdo = new PDO("pgsql:host=postgres; port=5432; dbname=mydb", 'user', 'pass');
        $stmt = $pdo->prepare("UPDATE user_products SET amount = :amount WHERE user_id = :user_id AND product_id = :product_id");
        $amountUpdate = $stmt->execute(['amount' => $sumAmount, 'user_id' => $userId, 'product_id' => $productId]);

        if ($amountUpdate) {
            $add =  'User products updated successfully';
        } else {
            $stmt = $pdo->prepare("INSERT INTO user_products (user_id, product_id, amount) VALUES (:user_id, :product_id, :amount)");
            $addProduct = $stmt->execute(['user_id' => $userId, 'product_id' => $productId, 'amount' => $amount]);
            if ($addProduct) {
                $add = 'Add to cart successfully';
            }
        }
    }

}
require_once './get_add_product.php';
