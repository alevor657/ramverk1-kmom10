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



    // TODO:
    public function upvote($replyId)
    {
        $this->di->get('user')->checkLogin();

        $userId = $this->di->get('session')->get('userId');
        $this->impression->upvote($userId, $replyId);

        // get author of comment
        $userId = $this->di->get('db')
            ->connect()
            ->select('User.id as userId')
            ->from('Reply')
            ->join('User', 'Reply.user_id = User.id')
            ->execute()
            ->fetch()
            ->userId;

        $this->di->get('user')->incrementRating($userId);

        $questionId = $this->di->get('request')->getGet('questionId');
        $this->di->get('response')->redirect("questions/$questionId");
    }



    // TODO:
    public function downvote($replyId)
    {
        $this->di->get('user')->checkLogin();

        $userId = $this->di->get('session')->get('userId');
        $this->impression->downvote($userId, $replyId);

        // get author of comment
        $userId = $this->di->get('db')
            ->connect()
            ->select('User.id as userId')
            ->from('Reply')
            ->join('User', 'Reply.user_id = User.id')
            ->execute()
            ->fetch()
            ->userId;

        $this->di->get('user')->incrementRating($userId, -1);

        $questionId = $this->di->get('request')->getGet('questionId');
        $this->di->get('response')->redirect("questions/$questionId");
    }
}
