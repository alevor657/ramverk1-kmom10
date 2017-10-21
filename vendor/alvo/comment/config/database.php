<?php

return [
    "dsn"              => "mysql:host=80.78.216.102;dbname=ramverk1;charset=utf8",
    "username"         => "tester",
    "password"         => "",
    "driver_options"   => [
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'",
        PDO::ATTR_ERRMODE,
        PDO::ERRMODE_EXCEPTION
    ],

    // True to be very verbose during development
    "verbose"         => null,

    // True to be verbose on connection failed
    "debug_connect"   => true,
];
