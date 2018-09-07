<?php

namespace Alvo\Question;

use \Anax\DI\InjectionAwareInterface;
use \Anax\Di\InjectionAwareTrait;
use \Anax\Database\ActiveRecordModel;
use \Alvo\User\User;
use \Alvo\Tags\Question2Tag;
use \Alvo\Tags\Tag;

/**
 * @SuppressWarnings("camelCase")
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
    public $rating = 0;
    // public $created;



    public function postQuestion()
    {
        $data = $this->di->get("request")->getPost();
        $userId = $this->di->get("session")->get("userId");

        $this->heading = $data["heading"];
        $this->text = $data["text"];
        $this->user_id = $userId;
        $this->save();

        if (!empty($data["tags"])) {
            $tags = explode(", ", trim($data["tags"]));
            $this->saveTags($tags, $this->id);
        }
    }



    public function populateQuestonsPageData()
    {
        $data = [];

        $allQuestions = $this->findAll();

        if (!$allQuestions) {
            return [];
        }

        foreach ($allQuestions as $question) {
            $user = new User();
            $user->setDb($this->di->get("db"));

            $user->findById($question->user_id);
            $question->userEmail = $user->email;
            $question->avatarUrl = $user->getGravatar();

            $question2Tag = new Question2Tag();
            $question2Tag->setDb($this->di->get("db"));

            $replyCount = $this->di->get('db')
                ->connect()
                ->select('COUNT(*) as replyCount')
                ->from('Reply')
                ->where('question_id = ?')
                ->execute([$question->id])
                ->fetch();

            $question->replyCount = $replyCount->replyCount;

            $binding = $question2Tag->findAllWhere("question_id = ?", $question->id);

            if (!$binding) {
                $question->tags = null;
                $data[] = $question;
                continue;
            }

            $tagIds = array_map(
                function ($obj) {
                    return $obj->tag_id;
                },
                $binding
            );

            // TODO:
            $tags = new Tag();
            $tags->setDb($this->di->get("db"));

            $tagsArray = $tags->findAllWhere("id IN (" . implode(', ', array_fill(0, sizeof($tagIds), '?')) . ")", $tagIds);
            $question->tags = $tagsArray;

            $data[] = $question;
        }

        // debug($data);
        return $data;
    }



    public function getQuestion($id)
    {
        $params = [$id];

        $data = $this->db
                ->connect()
                ->select("
                    User.email,
                    User.id as userId,
                    Question.heading,
                    Question.text,
                    Question.id as id,
                    GROUP_CONCAT(
                        DISTINCT CONCAT(Tags.id, ':', Tags.tag)
                        ORDER BY Tags.id
                        SEPARATOR ';'
                    ) as tags
                ")
                ->from($this->tableName)
                ->join('User', 'Question.user_id = User.id')
                ->join('Question2Tag', 'Question.id = Question2Tag.question_id')
                ->join('Tags', 'Question2Tag.tag_id = Tags.id')
                ->where('Question.id = ?')
                ->groupBy('email, heading, text, id')
                ->execute($params)
                ->fetch();

        $data->tags = explode(';', $data->tags);

        foreach ($data->tags as &$tag) {
            $tag = [
                "id" => explode(':', $tag)[0],
                "tag" => explode(':', $tag)[1]
            ];
        }

        return $data;
    }



    public function populateFirstPage()
    {
        $questions = $this->db
            ->connect()
            ->select()
            ->from('Question')
            ->limit(5)
            ->orderBy('Question.created DESC')
            ->execute()
            ->fetchAll();

        foreach ($questions as $question) {
            $question->text = $this->di->get("textfilter")->doFilter($question->text, "markdown");
        }

        $popularTags = $this->di->get('db')
            ->connect()
            ->select("Tags.tag, count(Question2Tag.tag_id) as count, Tags.id")
            ->from("Tags")
            ->join('Question2Tag', 'Tags.id = Question2Tag.tag_id')
            ->groupBy('tag')
            ->limit(5)
            ->orderBy('count DESC')
            ->execute()
            ->fetchAll();

        $activeUsers = $this->di->get('db')
            ->connect()
            ->select("email, id, reputation")
            ->from("User")
            ->limit(5)
            ->orderBy('reputation DESC')
            ->execute()
            ->fetchAll();

        $user = new User();
        $activeUsers = $user->getGravatars($activeUsers);

        $data = [
            "questions" => $questions,
            "tags" => $popularTags,
            "users" => $activeUsers
        ];

        return $data;
    }



    private function saveTags(array $tags, $questionId)
    {
        $tag = new Tag();
        $tag->setDb($this->di->get("db"));

        $tagObjects = $tag->findAll();
        $dbtags = [];

        $tags = array_map('strtolower', $tags);
        $tags = array_map('trim', $tags);
        $tags = array_unique($tags);

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



    public function incrementRating($questionId)
    {
        $this->find('id', $questionId);
        $this->rating++;
        $this->update();
    }
}
