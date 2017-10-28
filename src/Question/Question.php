<?php

namespace Alvo\Question;

use \Anax\DI\InjectionAwareInterface;
use \Anax\Di\InjectionAwareTrait;
use \Anax\Database\ActiveRecordModel;

/**
 *
 */
class Question extends ActiveRecordModel implements InjectionAwareInterface
{
    use InjectionAwareTrait;



    /**
     * @var string $tableName name of the database table.
     */
    protected $tableName = "Question";

    /**
     * Columns in the table.
     *
     * @var integer $id primary key auto incremented.
     */
    public $id;
    public $heading;
    public $text;
    public $user_id;



    public function postQuestion()
    {
        $data = $this->di->get("request")->getPost();
        extract($data);
        $userId = $this->di->get("session")->get("userId");

        $this->heading = $heading;
        $this->text = $text;
        $this->user_id = $userId;
        $this->save();
    }



    public function saveTags($tags)
    {
        $tag = new Tag();
        $tag->setDb($this->di->get("db"));

        $tagObjects = $tag->findAll();
        $dbtags = [];

        foreach ($tagObjects as $tag) {
            $dbtags[] = $tag->tag;
        }

        $unique = array_diff($tags, $dbtags);

        foreach ($unique as $tagstr) {
            $tag = new Tag();
            $tag->setDb($this->di->get("db"));
            $tag->tag = $tagstr;
            $tag->save();
        }
    }
}
