<?php

require_once __DIR__."/../vendor/autoload.php" ;

use App\Http\Controllers\RegisterController;
use App\Factories\RouterFactory ;
use App\Template\View ;
use App\Http\Request ;


$router = RouterFactory::create();

$router->get("/register", function() {
    View::render("register");
});

$router->get("/", function() {
    echo "index" ;
});
$router->post("/register", [RegisterController::class, "register"]);

$router->get("/user/{id}", function() {
    View::render("home");
});

$router->get("/pessoa", function($request) {
    $request = new Request("lucas");


    echo $request->withHeader("text/xml");
});
$router->get("/about", function() {
    View::render("about") ;
});

$router->addNotFoundHandler(function() {
    View::render("404_page");
});

$router->run();

