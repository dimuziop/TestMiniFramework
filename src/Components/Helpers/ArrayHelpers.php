<?php
/**
 * Created by PhpStorm.
 * User: Patricio
 * Date: 17/3/2018
 * Time: 20:37
 */

namespace Sb\Components\Helpers;

class ArrayHelpers
{
    
    /*
     * Removes empty registers in array
     */
    public static function removeEmptys($array)
    {
        $array2 = array_map(function ($var) {
            if ($var !== '') {
                return $var;
            }
        }, $array);
        return array_filter($array2);
    }
    
    /*
     * Removes emptys and returns '/' when empty
     */
    
    public static function filtersRootTreatment($array)
    {
        $var = self::removeEmptys(explode('/',
            $array));
        if (\count($var) === 0) {
            $var = '/';
        }
        return $var;
    }
    /*
     * Returns the matched route request TODO: Needs refactorization, many loops.
     * TellDontAsk principle must be applied
     */
    public static function searchMeInRoutesArray($array, $me)
    {
        foreach ($me as $value){
            foreach ($array as $route){
                if(is_array($route['exploited_uri'])){
                    foreach ($route['exploited_uri'] as $frag){
                        if($frag === $value){
                            return $route;
                        }
                    }
                }
            }
        }
    }
    
    public static function getParamsOfClosure($items){
        foreach ($items as $param){
            $params[] = strstr($param, ':') ? strstr($param, ':') : null ;
        }
        return self::removeEmptys($params);
    }
    
}