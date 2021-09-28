<?php 

namespace App\Http ; 

class Request 
{
    private $request = [];
    private $response ;
    
    public function __construct()
    {
        if(isset($_GET)){
            $this->request = array_merge($this->request, $_GET);
        }

        if(isset($_POST)){
            $this->request = array_merge($this->request, $_POST);
        }
    }

    public function testRequest() : array
    {
        return $this->request ;
    }

}