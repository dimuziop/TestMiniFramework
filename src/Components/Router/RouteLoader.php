<?php
/**
 * Created by PhpStorm.
 * User: Patricio
 * Date: 17/3/2018
 * Time: 03:15
 */

namespace Sb\Components\Router;


class RouteLoader
{
    
    protected $routefiles = [];
    
    public function __construct($routefile = 'ApiRoutes.php')
    {
        $this->routefiles[] = $routefile;
    }
    
    public function load($router)
    {
        foreach ($this->routefiles as $file){
            $router;
            require $this->getFilePath($file);
        }
    }
    
    protected function getRoutePath()
    {
        return __DIR__ . '/../../../app/Routes/';
    }
    
    protected function getFilePath($file){
        return $this->getRoutePath().$file;
    }
    
    
}