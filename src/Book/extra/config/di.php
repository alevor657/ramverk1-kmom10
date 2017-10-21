<?php
/**
 * Configuration file for DI container.
 */
return [

    // Services to add to the container.
    "services" => [
        "bookController" => [
            "shared" => true,
            "callback" => function () {
                $obj = new \Alvo\Book\BookController();
                $obj->setDI($this);
                return $obj;
            }
        ],
    ],
];
