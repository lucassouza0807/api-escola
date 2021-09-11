<?php

namespace App\Template ;

use Exception ;

class View
{
    static function render($viewName)
    {
        $view = __DIR__."/../../views/".$viewName.".php";

        try{
            if(file_exists($view)){
                require $view ;
            }else{
                throw new Exception("The requested view {$view} does not exists");
            }
        }catch(\Exception $msg){
            $notFoundMessage = $msg->getMessage();
            echo "<h2> $notFoundMessage </h2";
        }
    }
}