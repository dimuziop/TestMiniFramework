<?php
/**
 * Created by PhpStorm.
 * User: Patricio
 * Date: 17/3/2018
 * Time: 03:28
 */

namespace Sb\Components\Cleaners;

use Sb\Components\Router\Router;

class UriMaker
{
    
    public static function indexCaller()
    {
        echo 'Helloooooo';
        die();
    }
    
    public static function detector(Router $router)
    {
        $requires = array_filter(explode('/', $router->getRequesturi()));
        if (count($requires) === 1) {
            self::indexCaller();
        } else {
            array_shift($requires);
            self::resourse($requires, $router);
        }
    }
    
    public static function resourse($requires, $router)
    {
        while (\count($requires) > 0){
            $resourse = array_shift($requires);
            $check = $router->check($resourse);
            if(!$check){
                break;
            }
        }
    }
}