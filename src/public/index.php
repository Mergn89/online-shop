<?php

$requestUri = $_SERVER['REQUEST_URI'];
$requestMethod = $_SERVER['REQUEST_METHOD']; //GET; POST;


if ($requestUri === '/registration') {
    switch($requestMethod) {
        case 'GET':
            require_once "./get_registration.php";
            break;
        case 'POST':
            require_once "./handle_registration.php";
            break;
        default:
            echo "$requestMethod не поддерживается адресом $requestUri";
            break;
    }

} elseif ($requestUri === "/login") {
    switch ($requestMethod) {
        case 'GET':
            require_once "./get_login.php";
            break;
        case 'POST':
            require_once "./handle_login.php";
            break;
        default:
            echo "$requestMethod не поддерживается адресом $requestUri";
            break;
    }

} elseif ($requestUri === "/catalog") {
    switch ($requestMethod) {
        case 'GET':
            require_once "./catalog.php";
            break;
//        case 'POST':
//            require_once "./handle_registration.php";
//            break;
        default:
            echo "$requestMethod не поддерживается адресом $requestUri";
            break;
    }

} elseif ($requestUri === "/add-product") {
    switch ($requestMethod) {
        case 'GET':
            require_once "./get_add_product.php";
            break;
        case 'POST':
            require_once "./handle_add_product.php";
            break;
        default:
            echo "$requestMethod не поддерживается адресом $requestUri";
            break;
    }

} else {
    http_response_code(404);
    require_once './404.php';
}









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

