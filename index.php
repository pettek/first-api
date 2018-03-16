<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

use POlbrot\Application\Application;
use Symfony\Component\HttpFoundation\Request;
use POlbrot\Config\Config;

require_once __DIR__ . '/vendor/autoload.php';

try {
    $app = new Application(
        new Config(
            ['custom-routes' => __DIR__ . '\src\POlbrot\Config\custom_routes.json']
        )
    );
} catch (\Doctrine\ORM\ORMException $e) {

}

$request = Request::createFromGlobals();
$response = $app->handle($request);
$response->send();