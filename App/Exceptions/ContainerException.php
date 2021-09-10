<?php

namespace App\Containers ;

require __DIR__."../../vendor/autoload.php" ;

use Psr\Container\ContainerExceptionInterface ;
use Exception ;

class ContainerException extends Exception implements ContainerExceptionInterface 
{

}
