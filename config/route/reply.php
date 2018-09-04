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
            "info" => "Make answer accepted",
            "requestMethod" => "get",
            "path" => "accept/{id:digit}",
            "callable" => ["reply", "acceptAnswer"],
        ],
        [
            "info" => "Make unaccepted",
            "requestMethod" => "get",
            "path" => "unaccept/{id:digit}",
            "callable" => ["reply", "unacceptAnswer"],
        ],
        [
            "info" => "Upvote",
            "requestMethod" => "get",
            "path" => "upvote/{replyId:digit}",
            "callable" => ["impression", "upvote"],
        ],
        [
            "info" => "Downvote",
            "requestMethod" => "get",
            "path" => "downvote/{replyId:digit}",
            "callable" => ["impression", "downvote"],
        ],
    ],
];
