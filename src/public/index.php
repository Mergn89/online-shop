<?php
//require_once './../Core/App.php';
//require_once './../Controller/UserController.php';
//require_once './../Controller/ProductController.php';
//require_once './../Controller/CartController.php';
//require_once './../Controller/OrderController.php';

$autoloadCore = function(string $className) {
    $path = "./../Core/$className.php";
    if(file_exists($path)){
        require_once $path;
        return true;
    }
    return false;
};

$autoloadController = function(string $className) {
    require_once "./../Controller/$className.php";
    $path = "./../Core/$className.php";
    if(file_exists($path)){
        require_once $path;
        return true;
    }
    return false;
};

$autoloadModel = function(string $className) {
    $path = "./../Model/$className.php";
    if(file_exists($path)){
        require_once $path;
        return true;
    }
    return false;
};

spl_autoload_register($autoloadCore);
spl_autoload_register($autoloadController);
spl_autoload_register($autoloadModel);

$app = new App();
$app->run();





