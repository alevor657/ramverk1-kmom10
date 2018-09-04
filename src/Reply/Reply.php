<?php

namespace Alvo\Reply;

use \Anax\Database\ActiveRecordModel;
use \Anax\DI\InjectionAwareInterface;
use \Anax\Di\InjectionAwareTrait;
// use \Alvo\Tags\Question2Tag;
// use \Alvo\Tags\Tag;
use \Alvo\User\User;
use \Alvo\Question\Question;

/**
 * @SuppressWarnings("camelCase")
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
    public $accepted;
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
                Reply.accepted,
                User.email,
                User.id as userId,
                Reply.id as replyId,
                Reply.reply_to_id as replyTo
            ")
            ->from($this->tableName)
            ->join('User', 'User.id = Reply.user_id')
            ->where('Reply.question_id = ?')
            ->orderBy('Reply.accepted DESC')
            ->execute($params)
            ->fetchAll();

        $user = new User();
        $replies = $user->getGravatars($replies);

        foreach ($replies as $reply) {
            $reply->content = $this->di->get("textfilter")->doFIlter($reply->content, 'markdown');
        }

        $parents = array_filter($replies, function ($item) {
            return $item->replyTo == null;
        });

        foreach ($parents as $parent) {
            $parent->comments = $this->buildTree($replies, $parent);
        }

        return $parents;
    }



    private function buildTree(array $flat, $parent = null)
    {
        $res = [];

        foreach ($flat as $item) {
            if ($item->replyTo == $parent->replyId) {
                $children = $this->buildTree($flat, $item);

                if (!empty($children)) {
                    $item->comments = $children;
                }

                $res[] = $item;
            }
        }

        return $res;
    }



    public function acceptAnswer($id)
    {
        // Unmark all previously accepted answers
        $questionId = $this->di->get("request")->getGet("questionId");

        if (!$this->checkIfUserOwnsQuestion($questionId)) {
            return;
        }

        $acceptedAnswers = $this->findAllWhere('question_id = ?', $questionId);

        foreach ($acceptedAnswers as $answer) {
            $this->find('id', $answer->id);
            $this->accepted = 0;
            $this->save();
        }

        $this->find('id', $id);

        // Toggle value
        $this->accepted = 1;
        $this->save();
    }



    public function unacceptAnswer($id)
    {
        $questionId = $this->di->get("request")->getGet("questionId");

        if (!$this->checkIfUserOwnsQuestion($questionId)) {
            return;
        }

        $this->find('id', $id);

        // Toggle value
        $this->accepted = 0;
        $this->save();
    }



    private function checkIfUserOwnsQuestion($questionId)
    {
        $currentUserId = $this->di->get('session')->get('userId');

        $question = $this->di->get('db')
            ->connect()
            ->select('user_id as userId')
            ->from('Question')
            ->where('id = ?')
            ->execute([$questionId])
            ->fetch();

        return $question->userId == $currentUserId;
    }
}
