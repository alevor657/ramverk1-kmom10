<?php

namespace Alvo\User;

use Alvo\User\HTMLForm\CreateUserForm;



class CreateUserFormTest extends \PHPUnit_Framework_TestCase
{
    public static $di;
    public $comment;



    public function setUp()
    {
        self::$di = new \Anax\DI\DIFactoryConfig("testDi.php");

        $this->form = new CreateUserForm(self::$di);
    }



    public function testCallback()
    {
        $res = $this->form->callbackSubmit(self::$di);
        $this->assertFalse($res);
    }
}
