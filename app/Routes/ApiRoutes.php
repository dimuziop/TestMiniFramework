<?php
/**
 * Created by PhpStorm.
 * User: Patricio
 * Date: 17/3/2018
 * Time: 03:00
 */

namespace App\Routes;

use App\Controllers\Login;
use App\Controllers\Product;
use Sb\Components\Router\Routes;

/**
 * TODO: This part of the loader must be enhaced, with injection dependency and facades, for example
 * to pass any kind of middleware to manage another complex situations, this using of the instantiation
 * is for demostration purpose only;
*/
session_start();
$routes = new Routes($router);
$productController = new Product();
$loginController = new Login();


$routes->get('/products', function() use($productController){
    $productController->getAll();
})->get('/product/:id', function($id) use($productController){
    $productController->get($id);
})->post('/product', function() use($productController){
    $productController->store();
})->put('/product/:id', function ($id)use($productController){
    $productController->updates($id);
})->delete('/product/:id', function ($id) use($productController){
    $productController->delete($id);
});

$routes->get('/login', function() use($loginController){
    $loginController->login();
})->get('/login-callback', function() use($loginController, $router) {
    $loginController->callback($router->getGetVariables() !== null ? $router->getGetVariables() : null);
})->get('/getToken', function() use($loginController) {
    $loginController->getToken();
});



