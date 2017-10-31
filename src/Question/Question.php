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

        $this->saveTags($tags, $this->id);
    }



    private function saveTags($tags, $questionId)
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

        foreach ($tags as $tag) {
            $tagObj = new Tag();
            $tagObj->setDb($this->di->get("db"));

            $tagObj->find('tag', $tag);
            $question2Tag = new Question2Tag();
            $question2Tag->setDb($this->di->get("db"));
            $question2Tag->question_id = $questionId;
            $question2Tag->tag_id = $tagObj->id;
            $question2Tag->save();
        }
    }



    public function populateQuestonsPageData()
    {
        // $data = $this->db
        //         ->connect()
        //         ->select()
        //         ->from($this->tableName)
        //         ->join('Tag');
        //
        // debug($data);
    }
}
