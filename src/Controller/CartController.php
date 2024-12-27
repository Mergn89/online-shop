<?php
namespace Controller;
use Model\Product;
use Model\UserProduct;
use Request\AddProductRequest;

//require_once './../Model/UserProduct.php';

class CartController
{
    private UserProduct $userProduct;
    private Product $product;


    public function __construct()
    {
        $this->userProduct = new UserProduct();
        $this->product = new Product();

    }
    public function getCart():void
    {
        session_start();
        if (!isset($_SESSION['user_id'])) {
            header("location: /login");
        } else {

            $userId = $_SESSION['user_id'];

            $allUserProducts = $this->userProduct->getUserProductsByUserId($userId);
            if(!empty($allUserProducts)) {
                //$allPrice = $this->totalPrice();

                $productIds = [];

                foreach ($allUserProducts as $userProduct) {
                    $productIds[] = $userProduct->getProductId(); // $productIds[] = [[0] => 1, [1] =>2]; собираем id продуктов пользователя
                }
//                $productId = implode(',' , $productIds);
//
//                $productId = '?' . str_repeat(', ?', count($productIds) - 1); //преобразывает массив  в строку
//                var_dump($productId); die;
//                if (count($productIds) > 0) {
//
//                foreach ($productIds as &$productId){
//                    $productId = (string)$productId;
//                }
                //var_dump($productIds);die;

                    $userProducts = $this->product->getAllByIds($productIds);

                    $allPrice = 0;
                    foreach ($allUserProducts as $userProd) {
                        //$products = [];
                        foreach ($userProducts as $product) {
                            if ($userProd->getProductId() === $product->getId()) {
                                $product->setAmount($userProd->getAmount());
                                $total = $userProd->getAmount() * $product->getPrice();
                                $allPrice += $total;
                            }
                            //$products[] = $product;
                        }
                    }
//                foreach ($userProducts as $userProduct) {
//
//                    $allPrice += $total;
//                }
                //}
            }
        }
        require_once './../View/cart.php';
    }


    public function getAddProductForm():void
    {
        session_start();
        if (!isset($_SESSION['user_id'])) {
            header("location: /login");
        }
        require_once './../View/addProduct.php';
    }
    public function addProduct(AddProductRequest $request):void
    {
        $errors = $request->validate();

        if (empty($errors)) {
            $productId = $request->getProductId();
            $amount = $request->getAmount();
            session_start(); //сессия уже запущена выше
            if(isset($_SESSION['user_id'])){
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

        }
        require_once './../View/addProduct.php';
    }







//    public function totalPrice(): int
//    {
//        $userId = $_SESSION['user_id'];
//
//        $allUserProducts = $this->userProduct->getProductsByUserId($userId);
//        $allPrice = 0;
//        foreach ($userProducts as $product) {
//            $total = $product['amount']*$product['price'];
//
//            $allPrice += $total;
//        }
//        return $allPrice;
//    }



}