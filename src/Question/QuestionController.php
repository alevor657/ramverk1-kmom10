<?php

namespace Alvo\Question;

use \Anax\DI\InjectionAwareInterface;
use \Anax\Di\InjectionAwareTrait;

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
        $allTags = $this->tag->getAllTags();

        $data = $this->question->populateQuestonsPageData();

        $this->di->get("view")->add("question/questionsList", [
            "posts" => $posts,
            // "user" => $user
        ]);

        if ($this->di->get("user")->isLoggedIn()) {
            $this->di->get("view")->add(
                "question/createQuestionForm",
                [
                    "tags" => $allTags
                ]
            );
        }

        $this->di->get("pageRender")->renderPage(["title" => "Questions"]);
    }



    public function postQuestion()
    {
        $this->question->postQuestion();

        $this->di->get("response")->redirect("questions");
    }
}
