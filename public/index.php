<?php
require_once __DIR__ . "/../vendor/autoload.php";


$router = new \Bramus\Router\Router();
$router->setNamespace('\App\Controllers');
//middleware
require_once SRC_DIR . "/middlewares/index.php";
//routes
require_once SRC_DIR . "/routes/index.php";
//auth

$router->set404(fn () => view('404'));
$router->run();
