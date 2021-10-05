<?php

namespace App\middlewares ;

use Psr\Http\Server\MiddlewareInterface ;
use App\Http\Request;

class AuthenticationMiddleware //implements MiddlewareInterface
{
    //Refatorar!
    public function handle()
    {
        if(isset($_SESSION['login_id']) && isset($_SESSION['email'])){
            return $this->next($request);
        }else{
            //
        }
    }
}
