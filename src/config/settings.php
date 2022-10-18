<?php

/**
 * Settings array for framework
 */

return [
    'doctrine' => [

        'development' => $_ENV['APP_ENVIROMENT'] == "development" ? true : false,

        'cache_dir' => APP_ROOT . "/cache/doctrine",

        'metadata_dirs' => [
            APP_ROOT . DIRECTORY_SEPARATOR . "Entities" . DIRECTORY_SEPARATOR
        ],

        'connection' => [
            'driver' => $_ENV['DB_DRIVER'],
            'host' => $_ENV['DB_HOST'],
            'port' => $_ENV['DB_PORT'],
            'dbname' => $_ENV['DB_NAME'],
            'user' => $_ENV['DB_USERNAME'],
            'password' => $_ENV['DB_PASSWORD']
        ]
    ]

];
