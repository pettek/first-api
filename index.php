<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

use POlbrot\Application\Application;
use POlbrot\HTTP\Request;
use POlbrot\Config\Config;

require_once __DIR__.'/vendor/autoload.php';

$app = new Application(
    new Config(
        ['custom-routes' => __DIR__ . '\src\POlbrot\Config\custom_routes.json']
    )
);

$req = Request::createFromGlobals();
$response = $app->handle($req);
$response->send();
