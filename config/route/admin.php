<?php

return [
    "routes" => [
        [
            "info" => "Check if admin",
            "requestMethod" => "get",
            "path" => "**",
            "callable" => ["admin", "isAdmin"],
        ],
        [
            "info" => "Get all users",
            "requestMethod" => "get",
            "path" => null,
            "callable" => ["admin", "getIndex"],
        ],
        [
            "info" => "Delte a user",
            "requestMethod" => "get",
            "path" => "delete/{id:digit}",
            "callable" => ["admin", "deleteUser"],
        ],
        [
            "info" => "Edit a user",
            "requestMethod" => "get|post",
            "path" => "edit/{id:digit}",
            "callable" => ["admin", "editUser"],
        ],
    ]
];
