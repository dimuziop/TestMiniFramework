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
    
    protected static $client;
    
    public static function make()
    {
        $data = parse_ini_file(__DIR__ . '/../../config.ini');
        if(self::$client === null) {
            self::$client = new \Google_Client();
        }
        self::$client->setApplicationName('SatoshiTangoTest');
        self::$client->setClientId($data['Google']['cient_id']);
        self::$client->setClientSecret($data['Google']['secret']);
        self::$client->addScope(\Google_Service_Oauth2::USERINFO_PROFILE);
        self::$client->addScope(\Google_Service_Oauth2::USERINFO_EMAIL);
        self::$client->setRedirectUri(BASE_URL . 'login-callback');
    }
    
    public static function getUrlLogin()
    {
        self::make();
        return self::$client->createAuthUrl();
    }
    
    public static function auth($data = null){
        self::make();
        self::$client->authenticate($_GET['code']);
        $_SESSION['token'] = self::$client->getAccessToken();
    }
}