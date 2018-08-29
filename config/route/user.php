<?php

return [
    "routes" => [
        [
            "info" => "Profile",
            "requestMethod" => "get",
            "path" => "profile",
            "callable" => ["user", "getIndex"],
        ],
        [
            "info" => "Overview over another user",
            "requestMethod" => "get",
            "path" => "{id:digit}",
            "callable" => ["user", "getOverview"],
        ],
        [
            "info" => "Get login page",
            "requestMethod" => "get",
            "path" => "login",
            "callable" => ["user", "getLogin"],
        ],
        [
            "info" => "Login",
            "requestMethod" => "post",
            "path" => "login",
            "callable" => ["user", "logUserIn"],
        ],
        [
            "info" => "Get register page",
            "requestMethod" => "get",
            "path" => "register",
            "callable" => ["user", "getRegister"],
        ],
        [
            "info" => "Register",
            "requestMethod" => "post",
            "path" => "register",
            "callable" => ["user", "register"],
        ],
        [
            "info" => "Update",
            "requestMethod" => "post",
            "path" => "update",
            "callable" => ["user", "updateUser"],
        ],
        [
            "info" => "Logout",
            "requestMethod" => "get",
            "path" => "logout",
            "callable" => ["user", "logout"],
        ],
    ]
];
