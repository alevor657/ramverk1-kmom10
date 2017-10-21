<?php

namespace Alvo\User;

use Alvo\User\UserController;

/**
 * Test cases for Comment Controller
 */
class UserControllerTest extends \PHPUnit_Framework_TestCase
{
    public static $di;
    public static $userController;
    public static $user;



    public function setUp()
    {
        self::$di = new \Anax\DI\DIFactoryConfig("testDi.php");
        self::$userController = new UserController();

        self::$userController->setDI(self::$di);
        self::$user = new User();
        self::$user->setDI(self::$di);
        self::$userController->user = self::$user;
        self::$userController->response = self::$di->get('response');
    }



    /**
     * @runInSeparateProcess
     */
    public function testInit()
    {
        self::$userController->init();
    }


    /**
     * @runInSeparateProcess
     */
    public function testGetIndex()
    {
        self::$userController->getIndex();
    }
}
