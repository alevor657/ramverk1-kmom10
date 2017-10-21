<?php

namespace Alvo\Comment\HTMLForm;

use \Anax\HTMLForm\FormModel;
use \Anax\DI\DIInterface;
use \Alvo\Comment\Comment;

/**
 * Example of FormModel implementation.
 */
class EditCommentForm extends FormModel
{
    /**
     * Constructor injects with DI container.
     *
     * @param Anax\DI\DIInterface $di a service container
     */
    public function __construct(DIInterface $di, $id)
    {
        parent::__construct($di);

        $comment = new Comment();
        $comment->setDb($di->get("db"));
        $this->comment = $comment->getComment(null, $id);
        // debug($id);

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
                    "value" => $comment->heading,
                    "validation" => [
                        "not_empty"
                    ],
                ],

                "text" => [
                    "type" => "textarea",
                    "class" => "form-control",
                    "value" => $comment->text,
                    "validation" => [
                        "not_empty"
                    ],
                ],

                "tags" => [
                    "label" => "Space separated tags",
                    "type" => "text",
                    "class" => "form-control",
                    "value" => $comment->tags,
                    "validation" => [
                        "not_empty"
                    ],
                ],

                "submit" => [
                    "type" => "submit",
                    "value" => "Update comment",
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

        $this->comment->setDb($this->di->get("db"));
        $this->comment->heading = $heading;
        $this->comment->text = $text;
        $this->comment->tags = $tags;
        $this->comment->updated = date("Y-m-d H:i:s");
        $this->comment->save();

        $this->form->addOutput("Comment was updated");

        return true;
    }
}
