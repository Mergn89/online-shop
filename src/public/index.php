<?php
require_once './../Core/App.php';
require_once './../Controller/UserController.php';
require_once './../Controller/ProductController.php';
require_once './../Controller/CartController.php';
require_once './../Controller/OrderController.php';


$app = new App();
$app->run();

