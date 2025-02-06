<?php
namespace Controller;
use DTO\CreateOrderDTO;
use Model\Order;
use Model\OrderProduct;
use Model\Product;
use Request\OrderRequest;
use Service\Auth\AuthServiceInterface;
use Service\OrderService;

//require_once './../Model/Order.php';
//require_once './../Model/UserProduct.php';
//require_once './../Model/OrderProduct.php';
//require_once './../Controller/CartController.php';

class OrderController
{
    private OrderService $orderService;
    private AuthServiceInterface $authService;

    public function __construct(OrderService $orderService, AuthServiceInterface $authService)
    {
        $this->orderService = $orderService;
        $this->authService = $authService;
    }
    public function getOrderForm(): void
    {
//        session_start();
        if (!$this->authService->check()) {
            header('Location: /login');
//        } else {
//            $userId = $_SESSION['user_id'];
//            $res = $this->userProduct->getUserProductsByUserId($userId);
//            //$allUserProducts = $this->userProduct->getProductsByUserId($userId);
//            //$allPrice = $this->totalPrice();
//            $productIds = [];
//
//            if(!empty($res)){
//                foreach ($res as $userProduct) {
//                    $productIds[] = $userProduct->getProductId();//['product_id']; // $productIds[] = [[0] => 1, [1] =>2]; собираем id продуктов пользователя
//                }
//                $userProducts = $this->products->getAllByIds($productIds);
//
//                $total = 0;
//                foreach ($res as $userProd) {
//                    foreach ($userProducts as &$product) {
//                        if ($userProd->getProductId() === $product->getId()) {
//                            $product->setAmount($userProd->getAmount());
//                            $allPrice = $userProd->getAmount() * $product->getPrice();
//                            $total += $allPrice;
//                        }
//                    }
//                }
//            }
        } else {
            require_once "./../View/order.php";
        }
    }

    public function order(OrderRequest $request): void
    {
        $errors = $request->validate();

        if (empty($errors)) {
//            session_start();
            $userId = $this->authService->getCurrentUser()->getId();
            $contactName = $request->getContactName();
            $address = $request->getAddress();
            $phone = $request->getPhone();

//            if (!empty($allUserProducts)) {
//                $productIds = [];
//
//                foreach ($allUserProducts as $userProduct) {
//                    $productIds[] = $userProduct->getProductId(); // $productIds[] = [[0] => 1, [1] =>2]; собираем id продуктов пользователя
//                }
//                $userProducts = $this->products->getAllByIds($productIds);
//
//                $total = $this->orderService->getTotal($allUserProducts, $userProducts);
//            }
            $dto = new CreateOrderDTO($userId, $contactName, $address, $phone);
            $this->orderService->create($dto);
//            $this->order->createOrder($userId, $contactName, $address, $phone, $total);
//
//            $orderUser = $this->order->getOrderByUserId($userId);
//
//            foreach ($userProducts as $product){
//                $this->orderProduct->addProductInOrder($orderUser->getId(), $product->getId(), $product->getAmount(), $product->getPrice());
//            }
//            $this->userProduct->deleteProductByUserId($userId);
            header('Location: /orders');
        }
        require_once "./../View/order.php";
    }

    public function getOrdersForm(): void
    {
//        session_start();
        if (!$this->authService->check()) {
            header("location: /login");
        } else {
            $userId = $this->authService->getCurrentUser()->getId();

            $orders = $this->orderService->getOrders($userId);


//            $orders = Order::getAllByUserId($userId);
//
//            /*
//              $orders = [
//                [
//                    'id' => 1,
//                    'user_id' => 23,
//                    'contact_name' => 'Alex',
//                    'address' => 'Moscow',
//                    'total' => 2300
//
//                ],
//                [
//                    'id' => 2,
//                    'user_id' => 23,
//                    'contact_name' => 'Alex',
//                    'address' => 'Moscow'
//                    'total' => 1200
//                    ....
//                ]
//
//            ];*/
//
//            foreach ($orders as &$order) {
//                $orderProducts = OrderProduct::getByOrderId($order->getId());
//
//                /*$orderProducts = [
//                    [
//                        'id' => 1,
//                        'order_id' => 1,
//                        'product_id' => 2,
//                        'amount' => 5,
//                        'order_price' => 120
//                    ],
//                    [
//                        'id' => 2,
//                        'order_id' => 3,
//                        'product_id' => 1,
//                        'amount' => 3,
//                        'order_price' => 200
//                    ],
//
//                ];*/
//
//                if(!empty($orderProducts)) {
//                    $productIds = [];
//                    foreach ($orderProducts as $orderProduct){
//                        $productIds[] = $orderProduct->getProductId();
//                    }
//                    $products = Product::getAllByIds($productIds);
//
//                    foreach ($orderProducts as $orderProduct){
//                        foreach ($products as $product) {
//                            if ($product->getId() === $orderProduct->getProductId()) {
//                                $product->setAmount($orderProduct->getAmount());
//                                $product->setPrice($orderProduct->getOrderPrice());
//                            }
//                        }
//                        //unset($product);
//
//                    }
//                    $order->setProducts($products);//=> $allOrders;
//                }
//
//                //else {
////                    print_r('У Вас нет заказов');
////                }
////            $order['products'] = $products;
////                print_r($products); die;
////                $order['products'] = $products;
//            }
////            unset($order);
//        }
////                        echo '<pre>';
////                        print_r($orders);
////                        echo '</pre>';
////                        echo '<pre>';
////                        print_r($order);
////                        echo '</pre>';
////                        die;
////        print_r($orders); die;
            require_once "./../View/orders.php";
        }
    }

}