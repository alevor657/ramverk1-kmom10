<?php

namespace Alvo\User;

use Alvo\User\User;

/**
 * Test cases for Comment Controller
 */
class UserTest extends \PHPUnit_Framework_TestCase
{
    public static $di;
    public static $user;



    public function setUp()
    {
        self::$di = new \Anax\DI\DIFactoryConfig("testDi.php");
        self::$user = new User();

        self::$user->setDb(self::$di->get('db'));
        self::$user->setDI(self::$di);
    }

    public function testSetPassword()
    {
        self::$user->setPassword('test');
        self::$user->email = 'alevor657@gmail.com';
    }



    public function testVerifyPassword()
    {
        $res = self::$user->verifyPassword('alevor657@gmail.com', 123);
        $this->assertInternalType('boolean', $res);
    }



    public function testGetAllUsers()
    {
        $res = self::$user->getAllUsers();
        $this->assertInternalType('array', $res);
    }



    public function testGetGravatar()
    {
        $res = self::$user->getGravatar();
        $this->assertInternalType('string', $res);
    }



    public function testDelete()
    {
        $user = self::$user->find('email', 'test@test.test123');
        self::$user->delete($user->id);
        $user = self::$user->find('email', 'test@test.test123');
        $this->assertNotNull($user->deleted);
    }



    public function testLogin()
    {
        $res = self::$user->login('test@test.test', 123);
        $this->assertInternalType('boolean', $res);
    }
}
