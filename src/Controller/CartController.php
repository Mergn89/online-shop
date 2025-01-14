<?php
namespace Controller;
use DTO\CartDTO;
use Model\Product;
use Model\UserProduct;
use Request\AddProductRequest;
use Service\CartService;

//require_once './../Model/UserProduct.php';

class CartController
{
    private UserProduct $userProduct;
    private Product $product;
    private CartService $cartService;

    public function __construct()
    {
        $this->userProduct = new UserProduct();
        $this->product = new Product();
        $this->cartService = new CartService();

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

                $productIds = [];

                foreach ($allUserProducts as $userProduct) {
                    $productIds[] = $userProduct->getProductId(); // $productIds[] = [[0] => 1, [1] =>2]; собираем id продуктов пользователя
                }
                $userProducts = $this->product->getAllByIds($productIds);

                $total = 0;
                foreach ($allUserProducts as $userProd) {
                    //$products = [];
                    foreach ($userProducts as $product) {
                        if ($userProd->getProductId() === $product->getId()) {
                            $product->setAmount($userProd->getAmount());
                            $allPrice = $userProd->getAmount() * $product->getPrice();
                            $total += $allPrice;
                        }
                        //$products[] = $product;
                    }
                }
//                foreach ($userProducts as $userProduct) {
//
//                    $total += $total;
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
            if (isset($_SESSION['user_id'])) {
                $userId = $_SESSION['user_id'];
//                $dataUserProducts = $this->userProduct->getAmountByUserIdAndProductId($userId, $productId);
//                //print_r($dataUserProducts); die;
//
//                if (!$dataUserProducts) {
//                    $this->userProduct->addProductInUserProducts($userId, $productId, $amount);
//                    $add = 'Продукт добавлен';
//                } else {
//                    $sumAmount = $dataUserProducts->getAmount() + $amount;
//
//                    $this->userProduct->updateAmountInUserProducts($userId, $productId, $sumAmount);
//                    $add = 'Продукт обновлен';
//                }
                $dto = new CartDTO($userId, $productId, $amount);
                $this->cartService->addProduct($dto);
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