<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

header("Access-Control-Allow-Origin: http://localhost:3000");

$app = AppFactory::create();

$app->addRoutingMiddleware();

$errorMiddleware = $app->addErrorMiddleware(true, true, true);


$app->get("/alunos", "\App\Controllers\AlunoController:index");

$app->get("/aluno/{aluno_id}", "\App\Controllers\AlunoController:pesquisarPorId");

$app->run();