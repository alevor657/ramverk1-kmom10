<?php

namespace Alvo\Book\HTMLForm;

use \Anax\HTMLForm\FormModel;
use \Anax\DI\DIInterface;
use \Alvo\Book\Book;

/**
 * Form to update an item.
 */
class UpdateForm extends FormModel
{
    /**
     * Constructor injects with DI container and the id to update.
     *
     * @param Anax\DI\DIInterface $di a service container
     * @param integer             $id to update
     */
    public function __construct(DIInterface $di, $id)
    {
        parent::__construct($di);
        $book = $this->getItemDetails($id);
        $this->form->create(
            [
                "id" => __CLASS__,
                "legend" => "Update details of the item",
            ],
            [
                "id" => [
                    "type" => "text",
                    "validation" => ["not_empty"],
                    "readonly" => true,
                    "value" => $book->id,
                ],

                "title" => [
                    "type" => "text",
                    "validation" => ["not_empty"],
                    "value" => $book->title,
                ],

                "author" => [
                    "type" => "text",
                    "validation" => ["not_empty"],
                    "value" => $book->author,
                ],

                "submit" => [
                    "type" => "submit",
                    "value" => "Save",
                    "callback" => [$this, "callbackSubmit"]
                ],

                "reset" => [
                    "type"      => "reset",
                ],
            ]
        );
    }



    /**
     * Get details on item to load form with.
     *
     * @param integer $id get details on item with id.
     *
     * @return boolean true if okey, false if something went wrong.
     *
     * @SuppressWarnings(PHPMD)
     */
    public function getItemDetails($id)
    {
        $book = new Book();
        $book->setDb($this->di->get("db"));
        $book->find("id", $id);
        return $book;
    }



    /**
     * Callback for submit-button which should return true if it could
     * carry out its work and false if something failed.
     *
     * @return boolean true if okey, false if something went wrong.
     */
    public function callbackSubmit()
    {
        $book = new Book();
        $book->setDb($this->di->get("db"));
        $book->find("id", $this->form->value("id"));
        $book->title = $this->form->value("title");
        $book->author = $this->form->value("author");
        $book->save();
        $this->di->get("response")->redirect("book/update/{$book->id}");
    }
}
