<?php

namespace Alvo\Reply;

use \Anax\Database\ActiveRecordModel;
use \Anax\DI\InjectionAwareInterface;
use \Anax\Di\InjectionAwareTrait;
// use \Alvo\Tags\Question2Tag;
// use \Alvo\Tags\Tag;
// use \Alvo\User\User;

/**
 *
 */
class Reply extends ActiveRecordModel implements InjectionAwareInterface
{
    use InjectionAwareTrait;

    /**
     * @var string $tableName name of the database table.
     */
    protected $tableName = "Reply";

    /**
     * Columns in the table.
     *
     * @var integer $id primary key auto incremented.
     */
    public $id;
    public $content;
    public $user_id;
    public $question_id;
    public $reply_to_id;
    // public $created;

    public function postReply()
    {
        $reply = $this->di->get("request")->getPost();
        $userId = $this->di->get("session")->get("userId");

        $this->user_id = $userId;
        $this->question_id = $reply["questionId"] ?? null;
        $this->reply_to_id = $reply["replyId"] ?? null;
        $this->content = $reply["text"];
        $this->save();
    }

    public function getTree($questionId)
    {
        $params = [$questionId];

        $replies = $this->db
            ->connect()
            ->select("
                Reply.content,
                Reply.created,
                User.email,
                User.id as userId,
                Reply.id as replyId,
                Reply.reply_to_id as replyTo
            ")
            ->from($this->tableName)
            ->join('User', 'User.id = Reply.user_id')
            ->where('Reply.question_id = ?')
            ->execute($params)
            ->fetchAll();

        return $this->parseReplies($replies);
    }

    private function parseReplies($replies)
    {
        foreach($replies as $key => $reply) {
            if ($reply->replyTo != null) {
                $foundReferences = array_filter($replies, function($item) use ($reply) {
                    return $item->replyId == $reply->replyTo;
                });

                // debug($foundReferences);

                array_map(function($item) use ($reply) {
                    return $item->comments[] = $reply;
                }, $foundReferences);

                unset($replies[$key]);
            }
        }

        // debug($replies);
        return $replies;
    }
}
