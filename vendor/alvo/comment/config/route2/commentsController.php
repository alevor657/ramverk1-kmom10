<?php

return [
    "routes" => [
        // [
        //     "info" => "Check user",
        //     "requestMethod" => "get|post",
        //     "path" => "**",
        //     "callable" => ["comment", "loginRequired"],
        // ],
        [
            "info" => "Get all comments",
            "requestMethod" => "get|post",
            "path" => null,
            "callable" => ["comment", "getIndex"],
        ],
        [
            "info" => "Delte a comment",
            "requestMethod" => "get",
            "path" => "delete/{id:digit}",
            "callable" => ["comment", "deleteItem"],
        ],
        [
            "info" => "Edit a comment",
            "requestMethod" => "get|post",
            "path" => "edit/{id:digit}",
            "callable" => ["comment", "editItem"],
        ],
    ]
];
