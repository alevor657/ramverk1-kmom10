<?php

namespace Alvo\Comment;

use Alvo\Comment\Comment;

/**
 * Test cases for Comment Controller
 */
class CommentTest extends \PHPUnit_Framework_TestCase
{
    public static $di;
    public $comment;



    public function testGetAllComments()
    {
        self::$di = new \Anax\DI\DIFactoryConfig("testDi.php");
        $this->assertInstanceOf("Anax\DI\DIInterface", self::$di);

        $this->comment = new Comment();
        $this->comment->setDb(self::$di->get("db"));
        $this->assertInstanceOf("Alvo\Comment\Comment", $this->comment);

        $val = $this->comment->getAllComments();
        $this->assertInternalType("array", $val);
        $this->assertContainsOnlyInstancesOf($this->comment, $val);
    }



    public function testGetComment()
    {
        $this->comment = new Comment();
        $this->comment->setDb(self::$di->get("db"));
        $this->comment->getComment("id", 0);
    }
}
