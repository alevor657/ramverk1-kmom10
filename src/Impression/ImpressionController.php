<?php

namespace Alvo\Impression;

use \Anax\DI\InjectionAwareInterface;
use \Anax\Di\InjectionAwareTrait;

/**
 * A controller class.
 */
class ImpressionController implements InjectionAwareInterface
{
    use InjectionAwareTrait;

    public function init()
    {
        $this->impression = new Impression();
        $this->impression->setDI($this->di);
        $this->impression->setDb($this->di->get("db"));
    }



    public function upvote($replyId)
    {
        $this->di->get('user')->checkLogin();

        $userId = $this->di->get('session')->get('userId');
        $this->impression->upvote($userId, $replyId);

        $questionId = $this->di->get('request')->getGet('questionId');
        $this->di->get('response')->redirect("questions/$questionId");
    }



    public function downvote($replyId)
    {
        $this->di->get('user')->checkLogin();

        $userId = $this->di->get('session')->get('userId');
        $this->impression->downvote($userId, $replyId);

        $questionId = $this->di->get('request')->getGet('questionId');
        $this->di->get('response')->redirect("questions/$questionId");
    }
}