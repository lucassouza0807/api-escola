<?php 

namespace App\Http ; 

class Request implements Psr\Http\Message\RequestInterface
{
    private $request = [];
    private $response ;
    
    function __construct($request)
    {
        $this->request = $request ;
    }
    
    public function withHeader($header)
    {
        header('Content-Type: {$header}; charset=utf-8');
        
        $json = json_encode($this->request);

        return $json ;

    }
}