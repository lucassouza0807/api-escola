<?php 

require_once __DIR__."/../vendor/autoload.php" ;

$env = Dotenv\Dotenv::createImmutable(__DIR__."/..");
$env->load();

define("DRIVER", $_ENV['DRIVER']);
define("HOST", $_ENV['HOST']);
define("DB_NAME", $_ENV['DB_NAME']);
define("DB_USER", $_ENV['DB_USER']);
define("DB_PASSWORD", $_ENV["DB_PASSWORD"]);

echo  DB_PASSWORD ;