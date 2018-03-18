<?php
/**
 * Created by PhpStorm.
 * User: Patricio
 * Date: 17/3/2018
 * Time: 02:46
 */

namespace Sb\Components\Router;


class Routes
{
    protected $router;
    
    public function __construct($router)
    {
        $this->router = $router;
    }
    
    public function get(string $uri, \Closure $function)
    {
        $this->store([
            'GET' => [
                'uri'      => $uri,
                'function' => $function,
            ],
        ]);
        return $this;
    }
    
    public function post(string $uri, \Closure $function)
    {
        $this->store([
            'POST' => [
                'uri'      => $uri,
                'function' => $function,
            ],
        ]);
        return $this;
    }
    
    public function put(string $uri, \Closure $function)
    {
        $this->store([
            'PUT' => [
                'uri'      => $uri,
                'function' => $function,
            ],
        ]);
        return $this;
    }
    
    public function delete(string $uri, \Closure $function)
    {
        $this->store([
            'DELETE' => [
                'uri'      => $uri,
                'function' => $function,
            ],
        ]);
        return $this;
    }
    
    protected function store($route){
        $this->router->store($route);
    }
    
}