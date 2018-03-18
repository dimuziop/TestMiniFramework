<?php
/**
 * Created by PhpStorm.
 * User: Patricio
 * Date: 16/3/2018
 * Time: 23:30
 */

namespace App;


use Sb\Components\Bootstrap\Bootstrap;

class App
{
    static function run(){
        Bootstrap::init();
    }
}