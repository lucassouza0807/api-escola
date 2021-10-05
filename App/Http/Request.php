<?php 

namespace App\Http ; 

class Request 
{
    private $request = [] ;
    
    public function __construct()
    {
        if(isset($_GET)){
            $this->request = array_merge($this->request, $_GET);
        }

        if(isset($_POST)){
            $this->request = array_merge($this->request, $_POST);
        }

        $this->request = filter_var_array($this->request, FILTER_SANITIZE_STRING);

        
    }

    public function input($user_input) : string
    {
        $input = $this->request[$user_input];

        return $input ;
    }

}