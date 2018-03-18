<?php
/**
 * Created by PhpStorm.
 * User: Patricio
 * Date: 17/3/2018
 * Time: 03:00
 */

namespace App\Routes;

use Sb\Components\Router\Routes;

/**
 * TODO: This part of the loader must be enhaced, with injection dependency and facades, for example
 * to pass any kind of middleware to manage another complex situations, this using of the instantiation
 * is for demostration purpose only;
*/

$routes = new Routes($router);

$routes->get('/', function (){
    return 'Hello';
})->get('/products', function(){
    return 'the products';
})->get('/product/:id', function($id){
    return 'the products';
})->post('/product', function(){
    return 'Store Product';
})->put('/product/:id', function ($id){
    return 'put the product';
})->delete('/product/:id', function ($id){
    return 'delete the product';
});



