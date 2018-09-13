<?php

namespace Alvo\Impression;

use \Anax\Database\ActiveRecordModel;
use \Anax\DI\InjectionAwareInterface;
use \Anax\DI\InjectionAwareTrait;

/**
 * @SuppressWarnings("camelCase")
 */
class Impression extends ActiveRecordModel implements InjectionAwareInterface
{
    use InjectionAwareTrait;

    /**
     * @var string $tableName name of the database table.
     */
    protected $tableName = "Impression";

    /**
     * Columns in the table.
     *
     * @var integer $id primary key auto incremented.
     */
    public $id;
    public $user_id;
    public $reply_id;
    public $value;



    public function upvote($userId, $replyId)
    {
        if ($this->isVotingSelf($replyId)) {
            return false;
        }

        $hasImpression = $this->hasUserImpression($userId, $replyId);

        $impressionChanged = null;

        if ($hasImpression) {
            $this->find('user_id = ? AND reply_id', [$userId, $replyId]);

            $impressionChanged = $this->value != 1;

            $this->user_id = $userId;
            $this->reply_id = $replyId;
            $this->value = 1;
            $this->update();
        } else {
            $impressionChanged = true;
            $this->user_id = $userId;
            $this->reply_id = $replyId;
            $this->value = 1;
            $this->save();
        }

        return $impressionChanged;
    }



    public function downvote($userId, $replyId)
    {
        if ($this->isVotingSelf($replyId)) {
            return false;
        }

        $hasImpression = $this->hasUserImpression($userId, $replyId);

        $impressionChanged = null;

        if ($hasImpression) {
            $this->find('user_id = ? AND reply_id', [$userId, $replyId]);

            $impressionChanged = $this->value != -1;

            $this->user_id = $userId;
            $this->reply_id = $replyId;
            $this->value = -1;
            $this->update();
        } else {
            $impressionChanged = true;
            $this->user_id = $userId;
            $this->reply_id = $replyId;
            $this->value = -1;
            $this->save();
        }

        return $impressionChanged;
    }



    private function hasUserImpression($userId, $replyId)
    {
        $res = $this->di->get('db')
            ->connect()
            ->select()
            ->from("Impression")
            ->where("user_id = ? AND reply_id = ?")
            ->execute([$userId, $replyId])
            ->fetch();

        return is_object($res);
    }



    private function isVotingSelf($replyId)
    {
        $currentUserId = $this->di->get('session')->get('userId', null);
        $reply = $this->di->get('db')
            ->connect()
            ->select()
            ->from("Reply")
            ->where("id = ? AND user_id = ?")
            ->execute([$replyId, $currentUserId])
            ->fetch();

        return is_object($reply);
    }
}
