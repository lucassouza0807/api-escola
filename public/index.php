<?php

require_once __DIR__."/../vendor/autoload.php" ;

use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController ;
use App\Factories\RouterFactory ;
use League\Plates\Engine ;

$router = RouterFactory::create();

$view = new Engine("../views", "php");

$router->post("/register_handler", [RegisterController::class, "registerNewUser"]);
$router->post("/login_handler", [LoginController::class, "login"]);

$teste = fn() => $view->render("register");

$router->get("/register", fn() => $view->render("register"));

$router->get("/login", fn() => $view->render("login_page"));

$router->get("/home", fn() => $nome = "lucas");


$router->addNotFoundHandler( fn() => $view->render("404_page") );


$router->run();

