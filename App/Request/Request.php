<?php 

namespace App\Request ;

use App\Interfaces\RequestInterface;

class Request implements RequestInterface
{
    function post($field) 
    {
        if(isset($_GET[$field])) {
            $sanitized_input = FILTER_SANITILIZE_STRING($_POST[$field]);
            return $_GET[$field];
        }
    }

    function get($field) 
    {
        if(isset($_GET[$field])) {
            $sanitized_input = FILTER_SANITILIZE_STRING($_POST[$field]);
            return $_GET[$field];
        }
    }

    function input($field) 
    {
        if(isset($_GET[$field])) {
            $sanitized_input = FILTER_SANITILIZE_STRING($_POST[$field]);
            return $_GET[$field];
        }
    }
   
} 