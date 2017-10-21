<?php

return [
    "dsn"      => "mysql:host=blu-ray.student.bth.se;dbname=alvo16;charset=utf8",
    "username" => "alvo16",
    "password" => "A5thzc2uwwHj",
    "driver_options"   => [
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'",
        PDO::ATTR_ERRMODE,
        PDO::ERRMODE_EXCEPTION
    ],
];

// return [
//     "dsn"              => "mysql:host=localhost;dbname=ramverk1;charset=utf8",
//     "username"         => "root",
//     "password"         => "",
//     "driver_options"   => [
//         PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'",
//         PDO::ATTR_ERRMODE,
//         PDO::ERRMODE_EXCEPTION
//     ],
// ];
