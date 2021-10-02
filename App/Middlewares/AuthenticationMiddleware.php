<?php

namespace App\middlewares ;

use Psr\Http\Server\MiddlewareInterface ;
use App\Http\Request;

class AuthenticationMiddleware //implements MiddlewareInterface
{
    public function process()
    {
        if(isset($_SESSION['login_id']) && isset($_SESSION['email'])){
            return $this->next($request);
        }else{
            echo "xfsd";
        }
    }
}

$middleware = new AuthenticationMiddleware();

$middleware->process("sda");