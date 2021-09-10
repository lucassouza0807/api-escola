<?php

namespace App\Template ;

use Exception ;

class View
{
    static function render($viewName)
    {
        $view = __DIR__."/../../views/".$viewName.".php";

        if(file_exists($view)){
            require $view ;
        }else{
            throw new Exception("<h1>The requested view {$viewName} does not exists </h1>");
        }
    }
}