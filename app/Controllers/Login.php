<?php
/**
 * Created by PhpStorm.
 * User: Patricio
 * Date: 19/3/2018
 * Time: 00:56
 */

namespace App\Controllers;

use Sb\Google\Gc;

class Login
{
    
    public function login(){
        $_SESSION['client'] = new Gc();
        $url = $_SESSION['client']->getUrlLogin();
        echo '<a href="'. $url.'"'. '>Login with google</a>';
    }
    
    public function callback($data){
        session_start();
        if(isset($data)){
            $data = substr($data, 5);
            $_SESSION['client']->auth($data);
            header('Location:' . BASE_URL . 'products');
            die();
        }
    }
    
    public function getData(){
        session_start();
        var_dump($_SESSION);
        die();
    }
}