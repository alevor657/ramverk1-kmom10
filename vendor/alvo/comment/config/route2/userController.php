<?php
/**
 * Routes for user controller.
 */
return [
    "routes" => [
        [
            "info" => "User Profile.",
            "requestMethod" => "get|post",
            "path" => "",
            "callable" => ["userController", "getIndex"],
        ],
        [
            "info" => "Login a user.",
            "requestMethod" => "get|post",
            "path" => "login",
            "callable" => ["userController", "getPostLogin"],
        ],
        [
            "info" => "Create a user.",
            "requestMethod" => "get|post",
            "path" => "create",
            "callable" => ["userController", "getPostCreateUser"],
        ],
        [
            "info" => "Logout",
            "requestMethod" => "get",
            "path" => "logout",
            "callable" => ["userController", "logout"],
        ],
    ]
];
