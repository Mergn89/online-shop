<?php

namespace Core;

use Controller\CartController;
use Controller\OrderController;
use Controller\ProductController;
use Controller\UserController;
use Service\Auth\AuthSessionService;
use Service\CartService;
use Service\OrderService;

class Container
{
    private array $services = [];

    public function get(string $class): object
    {
//        $services = [
//            UserController::class => function () {
//                $authService = new AuthSessionService();
//                return new UserController($authService);
//            },
//            ProductController::class => function () {
//                $authService = new AuthSessionService();
//                return new ProductController($authService);
//            },
//            CartController::class => function () {
//                $authService = new AuthSessionService();
//                $cartService = new CartService();
//                return new CartController($cartService, $authService);
//            },
//            OrderController::class => function () {
//                $authService = new AuthSessionService();
//                $orderService = new OrderService();
//                return new OrderController($orderService, $authService);
//            }
//        ];
        if(!isset($this->services[$class])) {
            return new $class();
        }

        $callback = $this->services[$class];
        return $callback($this);
//        $callback = function (Container $container) {  */$this = Container $container;*/
//        $authService = new AuthSessionService();
//        return new UserController($authService);
//        };
    }

    public function set(string $class, callable $callback): void
    {
        $this->services[$class] = $callback;

    }

}