<?php
namespace Core;
use Controller\CartController;
use Controller\OrderController;
use Controller\ProductController;
use Controller\UserController;
use Request\Request;
use Service\Auth\AuthSessionService;
use Service\CartService;
use Service\Logger\LoggerFileService;
use Service\Logger\LoggerServiceInterface;
use Service\OrderService;


class App
{
    private array $routes = [];
//    private array $services = [];
    private LoggerServiceInterface $loggerService;
    private Container $diContainer;

    public function __construct(LoggerServiceInterface $loggerService, Container $diContainer)
    {
        $this->routes = [];
//        $this->services = [];
        $this->loggerService = $loggerService;
        $this->diContainer = $diContainer;
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

               $objClass = $this->diContainer->get($class);

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
                    date_default_timezone_set('Asia/Irkutsk');

                    $this->loggerService->error("\n".'Произошла ошибка при обработке запроса', [
                        'message' => $exception->getMessage(),
                        'file' => $exception->getFile(),
                        'line' => $exception->getLine(),
                        'time' => date('d-m-Y H:i:s')
                    ]);
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

//    public function createObject(string $class): object
//    {
//        if($class === UserController::class) {
//            $authService = new AuthSessionService();
//            return new $class($authService);
//
//
//        } elseif ($class === ProductController::class) {
//            $authService = new AuthSessionService();
//            return new $class($authService);
//
//        } elseif ($class === CartController::class) {
//            $authService = new AuthSessionService();
//            $cartService = new CartService();
//            return new $class($cartService, $authService);
//
//        } elseif ($class === OrderController::class) {
//            $authService = new AuthSessionService();
//            $orderService = new OrderService();
//            return new $class($orderService, $authService);
//        }
//        return new $class();

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
////        $callback = function () {
////        $authService = new AuthSessionService();
////        return new UserController($authService);
////        };
//        $callback = $services[$class];
//        return $callback($this);
//    }

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
        //     'request'=>
        // ];

    }


}
