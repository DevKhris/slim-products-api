<?php

use App\Application;

define(
    'APP_ROOT',
    realpath(__DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR)
);
define(
    'ROUTE_PATH',
    APP_ROOT . DIRECTORY_SEPARATOR . 'routes'
);
define(
    'PUBLIC_PATH',
    realpath(
        APP_ROOT . DIRECTORY_SEPARATOR . '..' . '/public'
    )
);

require __DIR__ . '/../../vendor/autoload.php';

$app = new Application();

$app = $app->application;

(require __DIR__ . '/../config/middlewares.php')($app);

(require_once ROUTE_PATH . '/api.php')($app);

return $app;
