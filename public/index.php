<?php

require_once __DIR__."/../vendor/autoload.php" ;

use App\Factories\RouterFactory;
use App\Controllers\AlunoController;

header("Content-Type: Application/json");
header("Access-Control-Allow-Origin: http://localhost:3000");
header("Access-Control-Allow-Headers: Content-Type");
header("Connection: keep-alive");
header("Access-Control-Allow-Methods: HEAD, GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method,Access-Control-Request-Headers, Authorization");

$app = RouterFactory::create();

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    header("HTTP/1.1 200 OK");
    return;

}

$app->get("/alunos", [AlunoController::class, "index"]);

$app->get("/aluno", [AlunoController::class, "pesquisarPorId"]);

$app->get("/novo-usuario", function() {
    require_once __DIR__."/../views/form.php";
});


$app->post("/novo-aluno", [AlunoController::class, "cadastrarAluno"]);

$app->run();