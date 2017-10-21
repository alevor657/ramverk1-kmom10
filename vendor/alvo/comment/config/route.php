<?php
/**
 * Configuration file for routes.
 */
return [
    // Load these routefiles in order specified and optionally mount them
    // onto a base route.
    "routeFiles" => [
        [
            // Comments
            "mount" => "comments",
            "file" => __DIR__ . "/route2/commentsController.php",
        ],
        [
            "mount" => "admin",
            "file" => __DIR__ . "/route2/admin.php",
        ],
        [
            // Add routes from userController and mount on user/
            "mount" => "user",
            "file" => __DIR__ . "/route2/userController.php",
        ],
    ],

];
