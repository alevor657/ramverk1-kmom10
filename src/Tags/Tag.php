<?php

namespace Alvo\Tags;

use \Anax\Database\ActiveRecordModel;
use \Anax\DI\InjectionAwareInterface;
use \Anax\DI\InjectionAwareTrait;
use \Alvo\Question\Question;
use \Alvo\User\User;

/**
 * A database driven model.
 */
class Tag extends ActiveRecordModel implements InjectionAwareInterface
{
    use InjectionAwareTrait;


    /**
     * @var string $tableName name of the database table.
     */
    protected $tableName = "Tags";

    /**
     * Columns in the table.
     *
     * @var integer $id primary key auto incremented.
     */
    public $id;
    public $tag;

    public function getTagsPopularity()
    {
        $data = $this->di->get('db')
            ->connect()
            ->select("Tags.tag, count(Question2Tag.tag_id) as count, Tags.id")
            ->from($this->tableName)
            ->join('Question2Tag', 'Tags.id = Question2Tag.tag_id')
            ->groupBy('tag')
            ->orderBy('count DESC')
            ->execute()
            ->fetchAll();

        return $data;
    }



    public function getTagDetails($tagId)
    {
        $tagText = $this->find('id', $tagId)->tag;

        if (!$tagText) {
            return false;
        }

        $question = new Question();
        $question->setDb($this->di->get('db'));

        /**
         * Find all questions with given tag
         */
        $data = $this->di->get('db')
            ->connect()
            ->select('
                Question.heading,
                Question.text,
                Question.user_id,
                Question.rating,
                User.email as userEmail,
                Question.id as id,
                COUNT(Reply.id) as replyCount
            ')
            ->from('Question')
            ->join('Question2Tag', 'Question.id = Question2Tag.question_id')
            ->join('User', 'User.id = Question.user_id')
            ->join('Reply', 'Reply.question_id = Question.id')
            ->where('Question2Tag.tag_id = ?')
            ->groupBy('
                    Question.heading,
                    Question.text,
                    Question.user_id,
                    Question.rating,
                    userEmail,
                    id
                ')
            ->execute([$tagId])
            ->fetchAll();

        /**
         * Add avatar for each user
         */
        foreach ($data as $question) {
            $question->text = $this->di->get('textfilter')->doFilter($question->text, 'markdown');
            $user = new User();
            $user->setDb($this->di->get("db"));

            $user->findById($question->user_id);
            $question->avatarUrl = $user->getGravatar();
        }

        return [
            "tagText" => $tagText,
            "questions" => $data
        ];
    }
}
