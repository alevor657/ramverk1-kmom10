<?php

namespace Alvo\Comment;

use Alvo\Comment\CommentController;

/**
 * Test cases for Comment Controller
 */
class CommentControllerTest extends \PHPUnit_Framework_TestCase
{
    public static $di;
    public $comment;



    public function testInit()
    {
        self::$di = new \Anax\DI\DIFactoryConfig("testDi.php");
        $this->assertInstanceOf("Anax\DI\DIInterface", self::$di);

        $this->comment = new CommentController();
        $this->comment->setDI(self::$di);
        $this->comment->init();
        $this->assertInstanceOf("Alvo\Comment\CommentController", $this->comment);
        $this->assertInstanceOf('Anax\View\ViewCollection', $this->comment->view);
    }
}
