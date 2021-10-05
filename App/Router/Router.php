<?php

namespace App\Router ;

use App\Middlewares\AuthencationMiddleware ;
 
class Router
{
    private array $handlers ;
    private $notFoundHandler;

    private $middleware ;

    private const METHOD_POST = "POST" ;
    private const METHOD_GET = "GET" ;

    public function get(string $path, $handler, $middleware = null) : void
    {
        $this->addHandler(self::METHOD_GET, $path, $handler);
    
    }

    public function post(string $path, $handler, $middleware = null) : void
    {
        $this->addHandler(self::METHOD_POST, $path, $handler);
    }

    private function addHandler(string $method, string $path, $handler, $middleware = null) : void 
    {
        $this->handlers[$method . $path] = [
            'path' => $path,
            'method' => $method,
            'handler' => $handler,
            'middleware' => $middleware,
        ];
    }

    public function addNotFoundHandler($handler) : void 
    {
        $this->notFoundHandler = $handler ;
    }

    public function run()
    {
        $requestUri = parse_url(filter_var($_SERVER['REQUEST_URI'], FILTER_SANITIZE_URL));

        $requestPath = $requestUri['path'];
        $method = $_SERVER['REQUEST_METHOD'];

        $className = null ;
        $classMethod = null ;
        
        $callback = null ;

        foreach($this->handlers as $handler){
            
            if($handler['path'] === $requestPath && $method === $handler['method']){
                $callback = $handler['handler'];
            }
        }
        
        if(is_array($callback)){
            $className = new $callback[0];
            $classMethod = $callback[1];
            $callback = [$className, $classMethod];
            
        }

        if(is_callable($callback)){
            echo $callback();
            
        }

        if(!$callback){
            header("HTTP/1.0 404 Not Found");
            if(!empty($this->notFoundHandler)){
                $callback = $this->notFoundHandler ;
                echo $callback();
            }
        }

        call_user_func_array($callback, [
            array_merge($_GET, $_POST)
        ]);
        
    }


}