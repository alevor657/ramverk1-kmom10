<?php
/**
 * Config file for Anax comment.
 */
return [
    "userController" => [
        "shared" => true,
        "callback" => function () {
            $obj = new \Alvo\User\UserController();
            $obj->setDI($this);
            $obj->init();
            return $obj;
        }
    ],
    "user" => [
        "shared" => false,
        "callback" => function () {
            $obj = new \Alvo\User\User();
            $obj->setDI($this);
            $obj->setDb($this->get("db"));
            return $obj;
        }
    ],
    "comment" => [
        "shared" => true,
        "callback" => function () {
            $obj = new Alvo\Comment\CommentController();
            $obj->setDI($this);
            $obj->init();
            return $obj;
        }
    ],
    "admin" => [
        "shared" => true,
        "callback" => function () {
            $obj = new Alvo\User\AdminController();
            $obj->setDI($this);
            $obj->init();
            return $obj;
        }
    ],
    "db" => [
        "shared" => true,
        "callback" => function () {
            $obj = new \Anax\Database\DatabaseQueryBuilder();
            $obj->configure("database.php");
            return $obj;
        }
    ],
    "pageRender" => [
        "shared" => true,
        "callback" => function () {
            $obj = new \Alvo\Page\PageRender();
            $obj->setDI($this);
            return $obj;
        }
    ],
];
