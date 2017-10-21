<?php

namespace Anax\Response;

/**
 * Fail test response module.
 */
class ResponseFailTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test.
     * @expectedException \Anax\Response\Exception
     */
    public function testStatusCode()
    {
        $resp = new Response();
        $resp->setStatusCode(-1);
    }
}
