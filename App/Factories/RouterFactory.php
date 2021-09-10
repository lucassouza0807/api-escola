<?php 

namespace App\Factories ;

require_once __DIR__."/../../vendor/autoload.php" ;

use App\Providers\RouterServiceProvider ;

class RouterFactory
{
    static function create()
    {
        return new RouterServiceProvider ;
    }
} 