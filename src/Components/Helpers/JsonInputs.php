<?php
/**
 * Created by PhpStorm.
 * User: Patricio
 * Date: 18/3/2018
 * Time: 19:48
 */

namespace Sb\Components\Helpers;


class JsonInputs
{
    public static function getArrayFromJson(){
        $putfile = file_get_contents("php://input");
        parse_str($putfile, $data);
        $json = json_decode($data['data'], true);
        return self::sanitizeAndRemoveEmptys($json);
    }
    
    protected static function sanitizeAndRemoveEmptys($json){
        $array = array_map(function($var){
            return filter_var($var, FILTER_SANITIZE_STRING);
        },$json);
        return $array;
    }
}