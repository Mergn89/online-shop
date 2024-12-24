<?php
namespace Controller;

use Model\Product;
use Model\UserProduct;

//require_once './../Model/Products.php';
//require_once './../Model/UserProduct.php';

class ProductController
{
    private Product $products;
    private UserProduct $userProduct;

    public function __construct()
    {
        $this->products = new Product();
        $this->userProduct = new UserProduct();
    }

    public function getCatalog():void
    {
        session_start();
        if (!isset($_SESSION['user_id'])) {
            header("location: /login");
        }
        $products = $this->products->getProducts();

        require_once "./../View/catalog.php";
    }

    public function getAddProductForm():void
    {
        require_once './../View/addProduct.php';
    }
    public function addProduct():void
    {
        $errors = $this->productValidate($_POST);

        if (empty($errors)) {
            $productId = $_POST['product_id'];
            $amount = $_POST['amount'];
            //session_start(); сессия уже запущена выше
            $userId = $_SESSION['user_id'];

            $dataUserProducts = $this->userProduct->getAmountByUserIdAndProductId($userId, $productId);
            //print_r($dataUserProducts); die;

            if (!$dataUserProducts) {
                $this->userProduct->addProductInUserProducts($userId, $productId, $amount);
                $add = 'Add to cart successfully';
            } else {
                $sumAmount = $dataUserProducts->getAmount() + $amount;

                $this->userProduct->updateAmountInUserProducts($sumAmount, $userId, $productId);
                $add = 'User products updated successfully';
            }
        }
        require_once './../View/addProduct.php';
    }

    public function productValidate(array $post): array
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
                $errors['product_id'] = 'Поле не должно быть пустым или 0';
            } elseif (!ctype_digit($productId)) {
                $errors['product_id'] = 'Неправильный id продукта';

            } else {
                $product = $this->products->getOneById($productId);
                if (!$product) {
                    $errors['product_id'] = 'Продукт не существует';
                }
            }
        } else {
            $errors['product_id'] = 'Поле должно быть заполнено';
        }

        if (isset($post['amount'])) {
            $amount = $post['amount'];
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