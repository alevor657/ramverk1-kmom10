<?php

return [
    "routes" => [
        // [
        //     "info" => "Get all questions",
        //     "requestMethod" => "get",
        //     "path" => null,
        //     "callable" => ["tags", "getIndex"],
        // ],
        // [
        //     "info" => "Get all questions",
        //     "requestMethod" => "get",
        //     "path" => "{tagId:digit}/",
        //     "callable" => ["tags", "getSpecificTag"],
        // ],
        [
            "info" => "Post a reply",
            "requestMethod" => "post",
            "path" => null,
            "callable" => ["reply", "postReply"],
        ],
        [
            "info" => "Post a reply",
            "requestMethod" => "get",
            "path" => "accept/{id:digit}",
            "callable" => ["reply", "acceptAnswer"],
        ],
        [
            "info" => "Post a reply",
            "requestMethod" => "get",
            "path" => "unaccept/{id:digit}",
            "callable" => ["reply", "unacceptAnswer"],
        ],
    ],
];
