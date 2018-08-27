<?php

namespace Alvo\Question;

use \Anax\DI\InjectionAwareInterface;
use \Anax\Di\InjectionAwareTrait;
use \Alvo\Tags\Tag;

/**
 *
 */
class QuestionController implements InjectionAwareInterface
{
    use InjectionAwareTrait;



    public function init()
    {
        $this->question = new Question();
        $this->tag = new Tag();

        $this->question->setDI($this->di);
        $this->question->setDb($this->di->get("db"));
        $this->tag->setDb($this->di->get("db"));
    }



    public function getFirstPage()
    {
        $this->di->get("view")->add("index");
        $this->di->get("pageRender")->renderPage(["title" => "test"]);
    }



    public function getQuestionPage()
    {

        $data = $this->question->populateQuestonsPageData();

        $this->di->get("view")->add("question/questionsList", [
            "posts" => $data,
            // "user" => $user
        ]);

        if ($this->di->get("user")->isLoggedIn()) {
            $this->di->get("view")->add("question/createQuestionForm");
        }

        $this->di->get("pageRender")->renderPage(["title" => "Questions"]);
    }



    public function getSpecificPost($id)
    {
        $post = $this->question->getQuestion($id);

        $this->di->get("view")->add("question/questionPage", [
            "post" => $post,
        ]);

        $replies = $this->di->get('reply')->getTree($id);

        $this->di->get("view")->add("reply/replies", [
            "replies" => $replies,
            "questionId" => $id
        ]);


        $user = $this->di->get('user')->isLoggedIn();

        if ($user) {
            $this->di->get("view")->add("reply/replyForm", [
                "questionId" => $post->id
            ]);
        }

        $this->di->get("pageRender")->renderPage(["title" => $post->heading]);
    }



    public function postQuestion()
    {
        $this->question->postQuestion();

        $this->di->get("response")->redirect("questions");
    }
}
