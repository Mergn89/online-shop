<?php

require_once "./../../vendor/autoload.php";

use Mergen\Core\AuthServiceInterface;
use Mergen\Core\Autoload;
use Mergen\Core\App;

Autoload::registrate(__DIR__ . '/../'); //__DIR__ = абсолютный путь от корня   //   /var/www/html/

$loggerService = new \Service\Logger\LoggerFileService();

$container = new Mergen\Core\Container();

$container->set(\Controller\UserController::class, function (\Mergen\Core\Container $container) {
    $authService = $container->get(AuthServiceInterface::class);
    return new \Controller\UserController($authService);
});
$container->set(\Controller\ProductController::class, function (\Mergen\Core\Container $container) {
    $authService = $container->get(AuthServiceInterface::class);
    return new \Controller\ProductController($authService);
});
$container->set(\Controller\CartController::class, function (\Mergen\Core\Container $container) {
    $authService = $container->get(AuthServiceInterface::class);
    $cartService = new \Service\CartService();
    return new \Controller\CartController($cartService, $authService);
});
$container->set(\Controller\OrderController::class, function (\Mergen\Core\Container $container) {
    $authService = $container->get(AuthServiceInterface::class);
    $orderService = new \Service\OrderService();
    return new \Controller\OrderController($orderService, $authService);
});
$container->set(\Controller\ReviewController::class, function (\Mergen\Core\Container $container) {
    $authService = $container->get(\Mergen\Core\AuthServiceInterface::class);
    $reviewService = new \Service\ReviewService();
    $orderService = new \Service\OrderService();

    return new \Controller\ReviewController($reviewService, $authService, $orderService);
});

$container->set(Mergen\Core\LoggerServiceInterface::class, function () {
    return new \Service\Logger\LoggerFileService();
});
$container->set(Mergen\Core\AuthServiceInterface::class, function () {
    return new \Service\Auth\AuthSessionService();
});

$app = new App($loggerService, $container);

$app->addRoute('/registration', 'GET', \Controller\UserController::class, 'getRegistrationForm');
$app->addRoute('/registration', 'POST', \Controller\UserController::class, 'registrate', \Request\RegistrateRequest::class);
$app->addRoute('/login', 'GET', \Controller\UserController::class, 'getLoginForm');
$app->addRoute('/login', 'POST', \Controller\UserController::class, 'login', \Request\LoginRequest::class);
$app->addRoute('/logout', 'GET', \Controller\UserController::class, 'logout');

$app->addRoute('/catalog', 'GET', \Controller\ProductController::class, 'getCatalog');
$app->addRoute('/product', 'POST', \Controller\ProductController::class, 'getProductAverage', \Request\ProductRequest::class);

//$app->addRoute('/review', 'GET', \Controller\ReviewController::class, 'getRev',\Request\ReviewRequest::class);
//$app->addRoute('/rev', 'POST', \Controller\ReviewController::class, 'getReview', \Request\ProductRequest::class);
$app->addRoute('/review', 'POST', \Controller\ReviewController::class, 'addReview', \Request\ReviewRequest::class);
$app->addRoute('/reviews', 'GET', \Controller\ReviewController::class, 'getReviews', \Request\ReviewRequest::class);



$app->addRoute('/cart', 'GET', \Controller\CartController::class, 'getCart');
$app->addRoute('/add-product', 'GET', \Controller\CartController::class, 'getAddProductForm');
$app->addRoute('/add-product', 'POST', \Controller\CartController::class, 'addProduct', \Request\AddProductRequest::class);
$app->addRoute('/delete-product', 'POST', \Controller\CartController::class, 'deleteProduct', \Request\ProductRequest::class);

$app->addRoute('/order', 'GET', \Controller\OrderController::class, 'getOrderForm');
$app->addRoute('/order', 'POST', \Controller\OrderController::class, 'order', \Request\OrderRequest::class);
$app->addRoute('/orders', 'GET', \Controller\OrderController::class, 'getOrdersForm');

$app->run();








