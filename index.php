<?php

use POlbrot\Application\Application;
use POlbrot\HTTP\Request;
use POlbrot\Config\Config;

require_once __DIR__.'/vendor/autoload.php';

$app = new Application(
    new Config(
        ['custom-routes' => __DIR__.'\src\POlbrot\Config\custom_routes.json']
    )
);

$request = Request::createFromGlobals();
$response = $app->handle($request);
$response->send();
