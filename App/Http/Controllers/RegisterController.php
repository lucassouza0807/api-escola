<?php 

namespace App\Http\Controllers ;

use App\Http\Request ;

class RegisterController
{
    
    public function register()
    { 
        $request = new Request ;

        $test = $request->testRequest();

        print_r($test['nome']);
    }
}