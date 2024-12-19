<?php
namespace Controller;
use Model\Order;
use Model\OrderProduct;
use Model\UserProduct;
use Model\Products;

//require_once './../Model/Order.php';
//require_once './../Model/UserProduct.php';
//require_once './../Model/OrderProduct.php';
//require_once './../Controller/CartController.php';

class OrderController
{
    private Order $order;
    private OrderProduct $orderProduct;
    private UserProduct $userProduct;
    private CartController $cartController;
    private Products $products;

    public function __construct()
    {
        $this->order = new Order();
        $this->orderProduct = new OrderProduct();
        $this->userProduct = new UserProduct();
        $this->cartController = new CartController();
        $this->products = new Products();
    }
    public function getOrderForm(): void
    {
        session_start();
        if (!isset($_SESSION['user_id'])) {
            header('Location: /login');
        } else {
            $userId = $_SESSION['user_id'];
            $res = $this->userProduct->getProductsByUserId($userId);
            require_once "./../View/order.php";
        }

    }

    public function order(): void
    {
        $errors = $this->validateOrder($_POST);


        if (empty($errors)) {
            session_start();
            $userId = $_SESSION['user_id'];
            $contactName = $_POST['contact_name'];
            $address = $_POST['address'];
            $phone = $_POST['phone'];
            $total = $this->cartController->totalOrder();


            $this->order->createOrder($userId, $contactName, $address, $phone, $total);

            $orderUser = $this->order->getOrderByUserId($userId);

            foreach ($this->userProduct->getProductsByUserId($userId) as $product) {
                $this->orderProduct->addProductInOrder($orderUser['id'], $product['product_id'], $product['amount'], $product['price']);
            }
            $this->userProduct->deleteProductByUserId($userId);
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

    public function getOrdersForm(): void
    {
        session_start();

        if (!isset($_SESSION['user_id'])) {
            header("location: /login");
        } else {
            $userId = $_SESSION['user_id'];
            $orders = $this->order->getAllByUserId($userId);

            /*
              $orders = [
                [
                    'id' => 1,
                    'user_id' => 23,
                    'contact_name' => 'Alex',
                    'address' => 'Moscow',
                    'total' => 2300

                ],
                [
                    'id' => 2,
                    'user_id' => 23,
                    'contact_name' => 'Alex',
                    'address' => 'Moscow'
                    'total' => 1200
                    ....
                ]

            ];*/

            foreach ($orders as &$order) {
                $orderProducts = $this->orderProduct->getByOrderId($order['id']);
                /*$orderProducts = [
                    [
                        'id' => 1,
                        'order_id' => 1,
                        'product_id' => 2,
                        'amount' => 5,
                        'order_price' => 120
                    ],
                    [
                        'id' => 2,
                        'order_id' => 3,
                        'product_id' => 1,
                        'amount' => 3,
                        'order_price' => 200
                    ],

                ];*/
                $productIds = [];
                foreach ($orderProducts as $orderProduct){
                    $productIds[] = $orderProduct['product_id'];
                }

                if(count($productIds) > 0) {
                    $products = $this->products->getAllByIds($productIds);
//print_r($products);die;
                    foreach ($orderProducts as $orderProduct){
                        foreach ($products as &$product) {
//                        echo '<pre>';
//                        print_r($products);
//                        echo '</pre>';
//                        echo '<pre>';
//                        print_r($orderProducts);
//                        echo '</pre>';
//                        die;
                            if ($product['id'] === $orderProduct['product_id']) {
                                $product['order_amount'] = $orderProduct['amount'];
                                $product['order_price'] = $orderProduct['order_price'];
                            }
                        }
                        unset($product);
                    }
                } else {
                    print_r('У Вас нет заказов');
                }
//            $order['products'] = $products;
//                print_r($products); die;
                $order['products'] = $products;
            }
             unset($order);
        }
           require_once "./../View/orders.php";
    }


}