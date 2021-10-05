<?php 

namespace App\Factories ;

require_once __DIR__."/../../vendor/autoload.php" ;

use App\Router\Router ;

class RouterFactory
{
    static function create()
    {
        return new Router ;
    }
} 