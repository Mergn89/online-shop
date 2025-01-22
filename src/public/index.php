<?php
require_once "./../Core/Autoload.php";

use Core\App;
use Core\Autoload;


Autoload::registrate(__DIR__ . '/../'); //__DIR__ = абсолютный путь от корня   //   /var/www/html/

$loggerService = new \Service\Logger\LoggerFileService();

$app = new App($loggerService);

$app->addRoute('/registration', 'GET', \Controller\UserController::class, 'getRegistrationForm');
$app->addRoute('/registration', 'POST', \Controller\UserController::class, 'registrate', \Request\RegistrateRequest::class);
$app->addRoute('/login', 'GET', \Controller\UserController::class, 'getLoginForm');
$app->addRoute('/login', 'POST', \Controller\UserController::class, 'login', \Request\LoginRequest::class);
$app->addRoute('/catalog', 'GET', \Controller\ProductController::class, 'getCatalog');
$app->addRoute('/cart', 'GET', \Controller\CartController::class, 'getCart');
$app->addRoute('/add-product', 'GET', \Controller\CartController::class, 'getAddProductForm');
$app->addRoute('/add-product', 'POST', \Controller\CartController::class, 'addProduct', \Request\AddProductRequest::class);
$app->addRoute('/order', 'GET', \Controller\OrderController::class, 'getOrderForm');
$app->addRoute('/order', 'POST', \Controller\OrderController::class, 'order', \Request\OrderRequest::class);
$app->addRoute('/orders', 'GET', \Controller\OrderController::class, 'getOrdersForm');
$app->addRoute('/logout', 'GET', \Controller\UserController::class, 'logout');
$app->run();








