<?php
require_once './../Core/App.php';
require_once './../Controller/UserController.php';
require_once './../Controller/ProductController.php';
require_once './../Controller/CartController.php';
require_once './../Controller/OrderController.php';


$app = new App();
$app->run();
//
//$requestUri = $_SERVER['REQUEST_URI'];
//$requestMethod = $_SERVER['REQUEST_METHOD']; //GET; POST;
//
//
//if ($requestUri === '/registration') {
//    switch($requestMethod) {
//        case 'GET':
//            $userController = new UserController();
//            $userController->getRegistrationForm();
//            break;
//        case 'POST':
//            $userController = new UserController();
//            $userController->registrate();
//            break;
//        default:
//            echo "$requestMethod не поддерживается адресом $requestUri";
//            break;
//    }
//
//} elseif ($requestUri === "/login") {
//    switch ($requestMethod) {
//        case 'GET':
//            $userController = new UserController();
//            $userController->getLoginForm();
//            break;
//        case 'POST':
//            $userController = new UserController();
//            $userController->login();
//            break;
//        default:
//            echo "$requestMethod не поддерживается адресом $requestUri";
//            break;
//    }
//
//} elseif ($requestUri === "/catalog") {
//    switch ($requestMethod) {
//        case 'GET':
//            $productController = new ProductController();
//            $productController->getCatalog();
//            break;
////        case 'POST':
////            require_once "./handle_registration.php";
////            break;
//        default:
//            echo "$requestMethod не поддерживается адресом $requestUri";
//            break;
//    }
//
//} elseif ($requestUri === "/add-product") {
//    switch ($requestMethod) {
//        case 'GET':
//            $productController = new ProductController();
//            $productController->getAddProductForm();
//            break;
//        case 'POST':
//            $productController = new ProductController();
//            $productController->getAddProduct();
//            break;
//        default:
//            echo "$requestMethod не поддерживается адресом $requestUri";
//            break;
//    }
//
//} elseif ($requestUri === "/cart") {
//    switch ($requestMethod) {
//        case 'GET':
//            $cartController = new CartController();
//            $cartController->getCart();
//            break;
//        case 'POST':
////            $cartController = new CartController();
////            $cartController->getCart();
////            break;
////        case 'POST':
////            require_once "./handle_registration.php";
////            break;
//        default:
//            echo "$requestMethod не поддерживается адресом $requestUri";
//            break;
//    }
//
//} elseif ($requestUri === "/logout") {
//    switch ($requestMethod) {
//        case 'GET':
//            $userController = new UserController();
//            $userController->logout();
//            break;
////        case 'POST':
////            require_once "./handle_registration.php";
////            break;
//        default:
//            echo "$requestMethod не поддерживается адресом $requestUri";
//            break;
//    }
//
//} elseif ($requestUri === "/order") {
//    switch ($requestMethod) {
//        case 'GET':
//            $orderController = new OrderController();
//            $orderController->getOrderForm();
//            break;
//        case 'POST':
//            $orderController = new OrderController();
//            $orderController->getOrder();
//            break;
//        default:
//            echo "$requestMethod не поддерживается адресом $requestUri";
//            break;
//    }
//
//
//} elseif ($requestUri === "/cart-test") {
//    switch ($requestMethod) {
//        case 'GET':
//            require_once "./cart_test.php";
//            break;
//
//        default:
//            echo "$requestMethod не поддерживается адресом $requestUri";
//            break;
//    }
//} else {
//    http_response_code(404);
//    require_once './../View/404.php';
//}









//if ($requestUri === '/registration') {
//
//    if ($requestMethod === 'GET') {
//        require_once "./get_registration.php";
//    } elseif($requestMethod === 'POST') {
//          require_once "./handle_registration.php";
//      }
//      else {
//          echo "$requestMethod не поддерживается адресом $requestUri";
//      }
//
//}
//  elseif ($requestUri === "/login") {
//
//      if ($requestMethod === "GET") {
//          require_once "./get_login.php";
//      } elseif ($requestMethod === "POST") {
//          require_once "./handle_login.php";
//      }
//      else {
//          echo "$requestMethod не поддерживается адресом $requestUri";
//      }
//  }
//  elseif($requestUri === "/catalog") {
//
//      if ($requestMethod === 'GET') {
//          require_once './catalog.php';
//      }// elseif ($requestMethod ==='POST') {
////        require_once './catalog.php';
////      }
//      else {
//          echo "$requestMethod не поддерживается адресом $requestUri";
//      }
//  }
//  else {
//      http_response_code(404);
//      require_once './404.php';
//  }

