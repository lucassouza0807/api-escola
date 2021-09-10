<?php 

class Test
{
    static $table = "pessoa" ;

    function testarVariable()
    {
        echo "Test..." ;
    }
}

$obj = new Test ;
call_user_func_array([$obj, "testarVariable"], []);