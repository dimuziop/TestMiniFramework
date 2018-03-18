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
    
    public static function searchMeInRoutesArray($array, $me)
    {
        if($me === '/'){
        
        }
        var_dump($array, $me);
        $regme = sprintf('/'.$me.'/');
        array_filter($array, function ($var) use ($regme) {
            return preg_match($regme, $var);
        });
    }
    
}