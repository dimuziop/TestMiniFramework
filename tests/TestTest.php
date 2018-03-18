<?php
/**
 * Created by PhpStorm.
 * User: Patricio
 * Date: 16/3/2018
 * Time: 23:16
 */

namespace Tests;

/**
 * Class TestDummy
 * Test the fucntionality of the initial test suite configuration
 * @package Tests
 */
class TestDummy extends TestCase
{
    /**
     * @test
     */
    function it_asserts(){
        $this->assertTrue(true);
    }
}