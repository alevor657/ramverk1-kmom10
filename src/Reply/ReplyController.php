<?php

namespace Alvo\Reply;

use \Anax\DI\InjectionAwareInterface;
use \Anax\Di\InjectionAwareTrait;

/**
 *
 */
class ReplyController implements InjectionAwareInterface
{
    use InjectionAwareTrait;



    public function init()
    {
        $this->reply = new Reply();
        $this->reply->setDI($this->di);
        $this->reply->setDb($this->di->get("db"));
    }



    public function postReply()
    {
        $this->di->get('user')->checkLogin();

        $id = $this->di->get('request')->getPost()["questionId"];
        $this->reply->postReply();

        $userId = $this->di->get('session')->get('userId');
        $this->di->get('user')->incrementRating($userId);

        $this->di->get("response")->redirect("questions/$id");
    }



    public function getTree($id, $sortingMethod)
    {
        return $this->reply->getTree($id, $sortingMethod);
    }



    public function acceptAnswer($id)
    {
        $this->reply->acceptAnswer($id);

        $questionId = $this->di->get("request")->getGet("questionId");
        $this->di->get("response")->redirect("questions/$questionId");
    }



    public function unacceptAnswer($id)
    {
        $this->reply->unacceptAnswer($id);

        $questionId = $this->di->get("request")->getGet("questionId");
        $this->di->get("response")->redirect("questions/$questionId");
    }
}
