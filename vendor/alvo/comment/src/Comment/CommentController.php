<?php

namespace Alvo\Comment;

use \Anax\DI\InjectionAwareInterface;
use \Anax\DI\InjectionAwareTrait;
use \Alvo\Comment\HTMLForm\AddCommentForm;
use \Alvo\Comment\HTMLForm\EditCommentForm;
use \Alvo\User\User;

class CommentController implements InjectionAwareInterface
{
    use InjectionAwareTrait;



    public function init()
    {
        $this->db = $this->di->get("db");
        $this->view = $this->di->get("view");
        $this->pageRender = $this->di->get("pageRender");
        $this->response = $this->di->get("response");
        // $this->comment = new Comment();
    }



    public function getIndex()
    {
        $title = "Comments";

        $comment = new Comment();
        $comment->setDb($this->di->get("db"));
        $posts = $comment->getAllComments() ? $comment->getAllComments() : [];
        // debug($posts);

        $user = $this->di->get("user");
        $user->setDb($this->db);
        $user = $user->getUser();

        $form = new AddCommentForm($this->di);
        $form->check();

        $this->view->add("comments/index", [
            "posts" => $posts,
            "form" => $form->getHTML(),
            "user" => $user
        ]);

        $this->pageRender->renderPage(["title" => $title]);
    }

    public function editItem($id)
    {
        $title = "Edit comment";

        // $user = $this->di->get("user");
        // $user->setDb($this->db);
        // $user = $user->getUser();

        $form = new EditCommentForm($this->di, $id);
        $form->check();

        $this->view->add("comments/edit", [
            "form" => $form->getHTML(),
            // "user" => $user
        ]);

        $this->pageRender->renderPage(["title" => $title]);
    }

    public function deleteItem($id)
    {
        $comment = new Comment();
        $comment->setDb($this->db);
        $comment->find("id", $id);
        $comment->deleted = date("Y-m-d H:i:s");
        $comment->save();

        $this->response->redirect("comments");
    }

    // public function loginRequired()
    // {
        // $user = $this->di->get("user");
        // if (!$user->isLoggedIn()) {
        //     $this->response->redirect("user/login");
        // }
    // }
}


// TODO:
// Users CRUD
