<?php

return [
    "routes" => [
        [
            "info" => "Get all questions",
            "requestMethod" => "get",
            "path" => null,
            "callable" => ["question", "getFirstPage"],
        ],
    ]
];
