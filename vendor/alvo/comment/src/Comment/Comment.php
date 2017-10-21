<?php

namespace Alvo\Comment;

use \Anax\Database\ActiveRecordModel;
use \Anax\DI\InjectionAwareInterface;
use \Anax\DI\InjectionAwareTrait;

class Comment extends ActiveRecordModel
{
    /**
     * @var string $tableName name of the database table.
     */
    protected $tableName = "Comment";

    /**
     * Columns in the table.
     *
     * @var integer $id primary key auto incremented.
     */
    public $id;
    public $text;
    public $heading;
    public $created;
    public $tags;
    public $userId;



    public function getAllComments()
    {
        return $this->db->connect()
                    ->select("
                        Comment.id,
                        Comment.text,
                        Comment.heading,
                        Comment.created,
                        Comment.tags,
                        Comment.userId,
                        User.email
                    ")
                    ->from($this->tableName)
                    ->where("Comment.deleted IS NULL")
                    ->join("User", "User.id = Comment.userId")
                    // ->getSQL();
                    ->execute()
                    ->fetchAllClass(get_class($this));

        // debug($t);
        // return $this->db->connect()
        //             ->select()
        //             ->from($this->tableName)
        //             ->where("deleted IS NULL")
        //             ->execute()
        //             ->fetchAllClass(get_class($this));
    }



    public function getComment($col = null, $val = null)
    {
        // debug($col);
        if (!$col) {
            $col = "id";
        }

        if (!$val && $val != 0) {
            throw new \Exception("CUSTOM ERR | No value provided to getComment");
        }

        return $this->find($col, $val);
    }
}
