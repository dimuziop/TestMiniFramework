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
    
    public function login()
    {
        $url = Gc::getUrlLogin();
        echo '<a href="' . $url . '"' . '>Login with google</a>';
    }
    
    public function callback($data = null)
    {
        if (isset($data)) {
            $data = substr($data, 5);
            Gc::auth($data);
            header('Location:' . BASE_URL . 'products');
            die();
        }
    }
    
    public function getToken()
    {
        if (isset($_SESSION['token'])) {
            $hash = password_hash(json_encode($_SESSION['token']),
                PASSWORD_BCRYPT, [
                    'cost' => 12,
                ]);
            var_dump(password_verify(json_encode($_SESSION['token']), $hash));
            die();
        }else{
            header('Location:' . BASE_URL . 'login');
            die();
        }
    }
}