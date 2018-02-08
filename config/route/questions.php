<?php

return [
    "routes" => [
        [
            "info" => "Get all questions",
            "requestMethod" => "get",
            "path" => null,
            "callable" => ["question", "getQuestionPage"],
        ],
        [
            "info" => "Post a question",
            "requestMethod" => "post",
            "path" => "postQuestion",
            "callable" => ["question", "postQuestion"],
        ],
    ]
];
