<?php
namespace Core;
use Request\Request;
use Request\RegistrateRequest;
use Service\LoggerService;


class App
{
    private array $routes = [];
    private LoggerService $loggerService;

    public function __construct()
    {
        $this->routes = [];
        $this->loggerService = new LoggerService();
    }

//    [
//        '/registration' => [
//            'GET' => [
//                'class' => 'Controller\UserController',
//                'method' => 'getRegistrationForm'
//            ],
//            'POST' => [
//                'class' => 'Controller\UserController',
//                'method' => 'registrate'
//            ]
//        ],
//        '/login' => [
//            'GET' => [
//                'class' => 'Controller\UserController',
//                'method' => 'getLoginForm'
//            ],
//            'POST' => [
//                'class' => 'Controller\UserController',
//                'method' => 'login'
//            ]
//        ],
//        '/catalog' => [
//            'GET' => [
//                'class' => 'Controller\ProductController',
//                'method' => 'getCatalog'
//            ],
//        ],
//        '/add-product' => [
//            'GET' => [
//                'class' => 'Controller\ProductController',
//                'method' => 'getAddProductForm'
//            ],
//            'POST' => [
//                'class' => 'Controller\ProductController',
//                'method' => 'addProduct'
//            ]
//        ],
//        '/cart' => [
//            'GET' => [
//                'class' => 'Controller\CartController',
//                'method' => 'getCart'
//            ],
//        ],
//        '/logout' => [
//            'GET' => [
//                'class' => 'Controller\UserController',
//                'method' => 'logout'
//            ],
//        ],
//        '/order' => [
//            'GET' => [
//                'class' => 'Controller\OrderController',
//                'method' => 'getOrderForm'
//            ],
//            'POST' => [
//                'class' => 'Controller\OrderController',
//                'method' => 'order'
//            ]
//        ],
//        '/orders' => [
//            'GET' => [
//                'class' => 'Controller\OrderController',
//                'method' => 'getOrdersForm'
//            ],
//        ],
//        '/cart-test' => [
//            'GET' => [
//                'class' => 'UserController',
//                'method' => 'getLoginForm'
//            ],
//        ],
//
//    ];

    public function run(): void
    {
        $uri = $_SERVER['REQUEST_URI'];
        $requestMethod = $_SERVER['REQUEST_METHOD']; //GET; POST;

        if (array_key_exists($uri, $this->routes)) {
            $methods = $this->routes[$uri];
            if (array_key_exists($requestMethod, $methods)) {

                $handler = $methods[$requestMethod];
                $class = $handler['class'];
                $method = $handler['method'];
                $requestClass = $handler['request'];
                $objClass = new $class();

                if (!empty($requestClass)){
                    $request = new $requestClass($uri, $requestMethod, $_POST);
                } else {
                    $request = new Request($uri, $requestMethod, $_POST);
                }

//                $request = new Request($uri, $requestMethod, $_POST);
//
//                if($uri === '/registrate'){
//                    $request = new RegistrateRequest($uri, $requestMethod, $_POST);
//
//                } elseif ($uri === '/login') {
//                    $request = new LoginRequest($uri, $requestMethod, $_POST);
                try{
                    $objClass->$method($request);

                } catch (\Throwable $exception) {
                    $this->loggerService->recordError($exception);
                    http_response_code(404);
                    require_once './../View/500.php';
                }

            } else {
                echo "$requestMethod не поддерживается $uri";
            }

        } else {
            http_response_code(404);
            require_once './../View/404.php';
        }

    }
    public function addRoute(string $route, string $routeMethod, string $className, string $methodName, string $requestClass = null): void
    {
        $this->routes[$route][$routeMethod] = [
            'class' => $className,
            'method' =>  $methodName,
            'request' => $requestClass
        ];
        // $this->array routes['/registration']['GET'] = [
        //     'class'=>'Controller\UserController',
        //     'method'=>'getRegistrationForm'
        // ];

    }


}
