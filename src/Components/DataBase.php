<?php
/**
 * Created by PhpStorm.
 * User: Patricio
 * Date: 17/3/2018
 * Time: 00:09
 */

namespace Sb\Components;


class DataBase
{
    
    public static function connect()
    {
        $data = self::getParameters();
        try {
            $conn = new \PDO("mysql:host={$data['server_name']};{$data['db_name']}",
                $data['username'], $data['password']);
            $conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            return $conn;
        } catch (PDOException $e) {
            $response = new JsonResponse(
                [
                    'Error'  => 'Misconfiguration database error, please, check documentantion',
                    'Detail' => $e->getMessage(),
                ],
                $_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error',
                true,
                500);
            $response->response();
        }
    }
    
    public static function getParameters()
    {
        $data = parse_ini_file(__DIR__ . '/../../config.ini');
        return $data['Database'];
    }
}