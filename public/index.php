<?php

require_once __DIR__."/../vendor/autoload.php" ;

use App\Factories\RouterFactory;
use App\Controllers\RegisterController;
use App\Providers\View ;

$router = RouterFactory::create();

$router->get("/register", function() {
    View::render("register");
});

$router->post("/register", [RegisterController::class, "register"]);

$router->get("/", function() {
    View::render("home");
});

$router->get("/pessoa", function() {
    
});
$router->get("/index", function() {
    echo "teste do meu pau" ;
});

$router->addNotFoundHandler(function() {
    View::render("404_page");
});

$router->run();

