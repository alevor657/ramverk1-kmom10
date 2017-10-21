<?php

namespace Alvo\Comment;

use Alvo\Comment\HTMLForm\EditCommentForm;

/**
 * Test cases for Comment Controller
 */
class EditCommentFormTest extends \PHPUnit_Framework_TestCase
{
    public static $di;
    public $comment;



    public function testInit()
    {
        self::$di = new \Anax\DI\DIFactoryConfig("testDi.php");

        $this->form = new EditCommentForm(self::$di, 28);
    }



    public function testCallback()
    {
        $this->form = new EditCommentForm(self::$di, 28);
        $this->form->callbackSubmit();
    }
}
