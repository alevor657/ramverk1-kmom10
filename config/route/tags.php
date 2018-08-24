<?php

return [
    "routes" => [
        [
            "info" => "Get all questions",
            "requestMethod" => "get",
            "path" => null,
            "callable" => ["tags", "getIndex"],
        ],
        [
            "info" => "Get all questions",
            "requestMethod" => "get",
            "path" => "{tagId:digit}/",
            "callable" => ["tags", "getSpecificTag"],
        ],
    ]
];
