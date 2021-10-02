<?php

require_once __DIR__."/../vendor/autoload.php" ;


use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController ;
use App\Factories\RouterFactory ;
use App\Template\View ;
use App\Http\Request ;


$router = RouterFactory::create();

$router->get("/register", function() {
    View::render("register");
});

$router->get("/login", function() {
    View::render("login_page");
});

$router->post("/register_handler", [RegisterController::class, "registerNewUser"]);
$router->post("/login_handler", [LoginController::class, "login"]);

$router->get("/user/{id}", function() {
    View::render("home");
});

$router->get("/pessoa", function($request) {
    echo "Pessoa";
});

$router->get("/about", function() {
    View::render("about") ;
});

$router->addNotFoundHandler(function() {
    View::render("404_page");
});

$router->run();

