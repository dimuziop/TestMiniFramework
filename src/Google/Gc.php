<?php
/**
 * Created by PhpStorm.
 * User: Patricio
 * Date: 19/3/2018
 * Time: 00:34
 */

namespace Sb\Google;

class Gc
{
    
    
    public function __construct()
    {
        session_start();
        $data = parse_ini_file(__DIR__ . '/../../config.ini');
        $client = new \Google_Client();
        $client->setApplicationName('SatoshiTangoTest');
        $client->setClientId($data['Google']['cient_id']);
        $client->setClientSecret($data['Google']['secret']);
        $client->addScope('https://www.googleapis.com/auth/userinfo.email https://www.googleapis.com/auth/plus.login');
        $client->setRedirectUri(BASE_URL . 'login-callback');
        $_SESSION['GC'] = $client;
    }
    
    public function getUrlLogin()
    {
        return $_SESSION['GC']->createAuthUrl();
    }
    
    public function fetchAccess($data){
        return $_SESSION['GC']->fetchAccessTokenWithAuthCode($data);
    }
}