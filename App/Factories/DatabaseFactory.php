<?php 

namespace App\Factories ;

use App\Database\Database ;

class DatabaseFactory
{
    public static function instance()
    {
        return new Database ;
    }
}
