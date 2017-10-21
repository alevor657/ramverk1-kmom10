<?php

namespace Alvo\Comment\HTMLForm;

use \Anax\HTMLForm\FormModel;
use \Anax\DI\DIInterface;
use \Alvo\Comment\Comment;

/**
 * Example of FormModel implementation.
 */
class AddCommentForm extends FormModel
{
    /**
     * Constructor injects with DI container.
     *
     * @param Anax\DI\DIInterface $di a service container
     */
    public function __construct(DIInterface $di)
    {
        parent::__construct($di);

        $this->form->create(
            [
                "id" => __CLASS__,
                "class" => "mb-2",
                "wrapper-element" => "div",
                "use_fieldset" => false,
            ],
            [
                "heading" => [
                    "type" => "text",
                    "class" => "form-control",
                    "validation" => [
                        "not_empty"
                    ],
                ],

                "text" => [
                    "type" => "textarea",
                    "class" => "form-control",
                    "validation" => [
                        "not_empty"
                    ],
                ],

                "tags" => [
                    "label" => "Space separated tags",
                    "type" => "text",
                    "class" => "form-control",
                    "validation" => [
                        "not_empty"
                    ],
                ],

                "submit" => [
                    "type" => "submit",
                    "value" => "Add post",
                    "callback" => [$this, "callbackSubmit"],
                    "class" => "btn btn-success"
                ],
            ]
        );
    }



    /**
     * Callback for submit-button which should return true if it could
     * carry out its work and false if something failed.
     *
     * @return boolean true if okey, false if something went wrong.
     */
    public function callbackSubmit()
    {
        // Get values from the submitted form
        $heading = $this->form->value("heading");
        $text = $this->form->value("text");
        $tags = $this->form->value("tags");

        $user = $this->di->get("user")->getUser();
        
        if (!$user) {
            return false;
        }
        $userId = $user->id;

        $comment = new Comment();
        $comment->setDb($this->di->get("db"));
        $comment->heading = $heading;
        $comment->text = $text;
        $comment->tags = $tags;
        $comment->userId = $userId;
        $comment->created = date("Y-m-d H:i:s");
        $comment->save();

        $this->form->addOutput("Comment was added");

        return true;
    }
}
