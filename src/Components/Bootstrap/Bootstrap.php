<?php
/**
 * Created by PhpStorm.
 * User: Patricio
 * Date: 16/3/2018
 * Time: 23:33
 */

namespace Sb\Components\Bootstrap;


use App\Routes\ApiRoutes;
use Sb\Components\DataBase;
use Sb\Components\JsonResponse;
use Sb\Components\Router\RouteLoader;
use Sb\Components\Router\Router;

class Bootstrap
{
    
    public static function init()
    {
        $config = self::readConfig();
        $router = new Router(new RouteLoader());
        $router->load();
        self::checkDbRequeriments($config['Database']);
    }
    
    protected static function readConfig()
    {
        $iniFile = __DIR__ . '/../../../config.ini';
        if (file_exists($iniFile)) {
            $data = parse_ini_file($iniFile);
            \define('BASE_URL', $data['App']['baseurl']);
            \define('API_NAME', $data['App']['name']);
            return $data;
        } else {
            $response = new JsonResponse(
                [
                    'Error' => 'Misconfiguration error, please, check documentantion',
                ],
                $_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error',
                true,
                500);
            $response->response();
        }
    }
    
    /**
     * this methods are just for the test purposes only
     */
    protected static function checkDbRequeriments($config)
    {
        $pdo = DataBase::connect();
        $stmt = $pdo->prepare('SELECT COUNT(*) FROM information_schema.schemata WHERE SCHEMA_NAME = :schema_name');
        $stmt->execute(['schema_name' => $config['db_name']]);
        $result = $stmt->fetch();
        if($result[0] === '0'){
            header('Location:http://localhost/SatoshiTango/installApi');
            die();
        }
    }
}