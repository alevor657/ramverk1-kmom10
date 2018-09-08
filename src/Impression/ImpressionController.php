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

        $currentUserId = $this->di->get('session')->get('userId');
        $isSuccess = $this->impression->upvote($currentUserId, $replyId);

        if ($isSuccess) {
            // get author of comment
            $authorId = $this->di->get('db')
                ->connect()
                ->select('user_id as userId')
                ->from('Reply')
                ->where('id = ?')
                ->execute([$replyId])
                ->fetch()
                ->userId;

            $this->di->get('user')->incrementRating($authorId);
        }


        $questionId = $this->di->get('request')->getGet('questionId');
        $this->di->get('response')->redirect("questions/$questionId");
    }



    // TODO:
    public function downvote($replyId)
    {
        $this->di->get('user')->checkLogin();

        $currentUserId = $this->di->get('session')->get('userId');
        $isSuccess = $this->impression->downvote($currentUserId, $replyId);

        if ($isSuccess) {
            // get author of comment
            $authorId = $this->di->get('db')
                ->connect()
                ->select('user_id as userId')
                ->from('Reply')
                ->where('id = ?')
                ->execute([$replyId])
                ->fetch()
                ->userId;

            $this->di->get('user')->incrementRating($authorId, -1);
        }

        $questionId = $this->di->get('request')->getGet('questionId');
        $this->di->get('response')->redirect("questions/$questionId");
    }
}
