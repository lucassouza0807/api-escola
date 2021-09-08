<?php

namespace App\Container ;

require __DIR__."/../vendor/autoload.php" ;


use Psr\Container\ContainerInterface;
use App\Containers\ContainerException ;
use App\Containers\NotFoundException;
use ReflectionClass;
use ReflectionException;

class Container implements ContainerInterface
{
    private $services = [];

    public function get($id)
    {
        $item = $this->resolve($id);
        if(!($item instanceof ReflectionClass)){
            return $item ;
        }

        return $this->getInstance($item);
    }

    public function has($id)
    {
        try{
            $item = $this->resolve($id);
        }catch(NotFoundException $e){
            return false ;
        }

        if ($item instanceof ReflectionClass) {
            return $item->isInstanstiable();
        }

        return isset($item);    
    }

    

}
