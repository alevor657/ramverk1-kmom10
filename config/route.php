<?php
/**
 * Configuration file for routes.
 */
return [
    // Load these routefiles in order specified and optionally mount them
    // onto a base route.
    "routeFiles" => [
        [
            // These are for internal error handling and exceptions
            "mount" => null,
            "file" => __DIR__ . "/route/internal.php",
        ],
        [
            "mount" => '',
            "file" => __DIR__ . "/route/home.php",
        ],
        [
            "mount" => "questions",
            "file" => __DIR__ . "/route/questions.php",
        ],
        [
            "mount" => "tags",
            "file" => __DIR__ . "/route/tags.php",
        ],
        [
            "mount" => "user",
            "file" => __DIR__ . "/route/user.php",
        ],
        [
            "mount" => "reply",
            "file" => __DIR__ . "/route/reply.php",
        ],
        [
            "mount" => "admin",
            "file" => __DIR__ . "/route/admin.php",
        ],
        [
            // For debugging and development details on Anax
            "mount" => "debug/",
            "file" => __DIR__ . "/route/debug.php",
        ],
        [
            // To read flat file content in Markdown from content/
            "mount" => null,
            "file" => __DIR__ . "/route/flat-file-content.php",
        ],
        [
            // Keep this last since its a catch all
            "mount" => null,
            "file" => __DIR__ . "/route/404.php",
        ],
    ],

];
