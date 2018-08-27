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
        $this->di->get("response")->redirect("questions/$id");
    }

    public function getTree($id)
    {
        return $this->reply->getTree($id);
    }
}
