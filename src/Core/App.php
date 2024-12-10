<?php
namespace Core;
class App
{
    private array $routes = [
        '/registration' => [
            'GET' => [
                'class' => 'Controller\UserController',
                'method' => 'getRegistrationForm'
            ],
            'POST' => [
                'class' => 'Controller\UserController',
                'method' => 'registrate'
            ]
        ],
        '/login' => [
            'GET' => [
                'class' => 'Controller\UserController',
                'method' => 'getLoginForm'
            ],
            'POST' => [
                'class' => 'Controller\UserController',
                'method' => 'login'
            ]
        ],
        '/catalog' => [
            'GET' => [
                'class' => 'Controller\ProductController',
                'method' => 'getCatalog'
            ],
        ],
        '/add-product' => [
            'GET' => [
                'class' => 'Controller\ProductController',
                'method' => 'getAddProductForm'
            ],
            'POST' => [
                'class' => 'Controller\ProductController',
                'method' => 'addProduct'
            ]
        ],
        '/cart' => [
            'GET' => [
                'class' => 'Controller\CartController',
                'method' => 'getCart'
            ],
        ],
        '/logout' => [
            'GET' => [
                'class' => 'Controller\UserController',
                'method' => 'logout'
            ],
        ],
        '/order' => [
            'GET' => [
                'class' => 'Controller\OrderController',
                'method' => 'getOrderForm'
            ],
            'POST' => [
                'class' => 'Controller\OrderController',
                'method' => 'order'
            ]
        ],
        '/orders' => [
            'GET' => [
                'class' => 'Controller\OrderController',
                'method' => 'getOrdersForm'
            ],
        ],
//        '/cart-test' => [
//            'GET' => [
//                'class' => 'UserController',
//                'method' => 'getLoginForm'
//            ],
//        ],

    ];

    public function run(): void
    {
        $uri = $_SERVER['REQUEST_URI'];
        $method = $_SERVER['REQUEST_METHOD']; //GET; POST;


        if (array_key_exists($uri, $this->routes)) {
            $methods = $this->routes[$uri];
            if (array_key_exists($method, $methods)) {

                $handler = $methods[$method];
                $class = $handler['class'];
                $method = $handler['method'];
                $obj = new $class();
                $obj->$method();

            } else {
                echo "$method не поддерживается $uri";
            }

        } else {
            http_response_code(404);
            require_once './../View/404.php';
        }

    }

}