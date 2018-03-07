<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

use POlbrot\Application\Application;
use POlbrot\HTTP\Request;

require_once __DIR__.'/vendor/autoload.php';

$app = new Application();

$req = Request::createFromGlobals();
$response = $app->handle($req);
$response->send();
