<?php

namespace Alvo\Question;

use \Anax\DI\InjectionAwareInterface;
use \Anax\Di\InjectionAwareTrait;
use \Alvo\Tags\Tag;
use \Alvo\User\User;

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
        $data = $this->question->populateFirstPage();

        $this->di->get("view")->add("index", ["data" => $data]);
        $this->di->get("pageRender")->renderPage(["title" => "Welcome!"]);
    }



    public function getQuestionPage()
    {

        $data = $this->question->populateQuestonsPageData();

        foreach ($data as $post) {
            $post->text = $this->di->get('textfilter')->doFilter($post->text, 'markdown');
        }

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
        $isLoggedIn = $this->di->get('user')->isLoggedIn();
        $isUserQuestionOwner = $this->di->get('session')->get('userId') == $post->userId;

        $this->di->get("view")->add("reply/replies", [
            "isUserQuestionOwner" => $isUserQuestionOwner,
            "loggedIn" => $isLoggedIn,
            "replies" => $replies,
            "questionId" => $id
        ]);

        if ($isLoggedIn) {
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
