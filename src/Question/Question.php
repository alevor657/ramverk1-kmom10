<?php

namespace Alvo\Question;

use \Anax\DI\InjectionAwareInterface;
use \Anax\Di\InjectionAwareTrait;
use \Anax\Database\ActiveRecordModel;
use \Alvo\User\User;

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



    public function populateQuestonsPageData()
    {
        // select * from Question inner join Question2Tag on
        // TODO: Populate needed data
        // posts, who, tags

        $data = [];

        $allQuestions = $this->findAll();

        foreach ($allQuestions as $question) {
            $user = new User();
            $user->setDb($this->di->get("db"));

            $user->findById($question->user_id);
            $question->userEmail = $user->email;

            $question2Tag = new Question2Tag();
            $question2Tag->setDb($this->di->get("db"));

            $binding = $question2Tag->findAllWhere("question_id = ?", $question->id);
            $tagIds = array_map(
                function ($obj)
                {
                    return $obj->tag_id;
                },
                $binding
            );

            // TODO:
            $tags = new Tag();
            $tags->setDb($this->di->get("db"));

            $tagsArray = $tags->findAllWhere("id in [${str_repeat('?,')]}", $tagIds);
            debug($tagsArray);
        }

        // $data = $this->db
        //         ->connect()
        //         ->select()
        //         ->from($this->tableName)
        //         ->join('User', 'user_id = `User`.id')
        //         ->join('Question2Tag', 'question_id = `Question`.id')
        //         ->join('Tag', '`Question2Tag`.tag_id = `Tag`.id')
        //         ->getSQL();
                // ->execute($params)
                // ->fetchAllClass(get_class($this));

        // $questions = $this->findAll();




        debug($data);
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
}
