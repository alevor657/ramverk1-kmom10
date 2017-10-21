<?php

namespace Alvo\Comment;

use Alvo\Comment\HTMLForm\AddCommentForm;

/**
 * Test cases for Comment Controller
 */
class AddCommentFormTest extends \PHPUnit_Framework_TestCase
{
    public static $di;
    public $comment;



    public function testInit()
    {
        self::$di = new \Anax\DI\DIFactoryConfig("testDi.php");

        $this->form = new AddCommentForm(self::$di);
    }



    public function testCallback()
    {
        $this->form = new AddCommentForm(self::$di);
        $this->form->callbackSubmit();
    }
}
