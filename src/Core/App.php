<?php

class App
{
    private array $routes = [
        '/registration' => [
            'GET' => [
                'class' => 'UserController',
                'method' => 'getRegistrationForm'
            ],
            'POST' => [
                'class' => 'UserController',
                'method' => 'registrate'
            ]
        ],
        '/login' => [
            'GET' => [
                'class' => 'UserController',
                'method' => 'getLoginForm'
            ],
            'POST' => [
                'class' => 'UserController',
                'method' => 'login'
            ]
        ],
        '/catalog' => [
            'GET' => [
                'class' => 'ProductController',
                'method' => 'getCatalog'
            ],
        ],
        '/add-product' => [
            'GET' => [
                'class' => 'ProductController',
                'method' => 'getAddProductForm'
            ],
            'POST' => [
                'class' => 'ProductController',
                'method' => 'addProduct'
            ]
        ],
        '/cart' => [
            'GET' => [
                'class' => 'CartController',
                'method' => 'getCart'
            ],
        ],
        '/logout' => [
            'GET' => [
                'class' => 'UserController',
                'method' => 'logout'
            ],
        ],
        '/order' => [
            'GET' => [
                'class' => 'OrderController',
                'method' => 'getOrderForm'
            ],
            'POST' => [
                'class' => 'OrderController',
                'method' => 'order'
            ]
        ],
        '/cart-test' => [
            'GET' => [
                'class' => 'UserController',
                'method' => 'getLoginForm'
            ],
        ],

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