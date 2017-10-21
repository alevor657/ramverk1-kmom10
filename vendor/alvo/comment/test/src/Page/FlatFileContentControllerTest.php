<?php

namespace Alvo\Page;

use Alvo\Page\FlatFileContentController;

/**
 * Test cases for Comment Controller
 */
class FlatFileContentControllerTest extends \PHPUnit_Framework_TestCase
{
    public static $con;
    public static $di;



    public function setUp()
    {
        self::$di = new \Anax\DI\DIFactoryConfig("testDi.php");
        self::$con = new FlatFileContentController();
        self::$con->setDI(self::$di);
    }



    public function testRender()
    {
        self::$con->render();
    }
}
