<?php

use POlbrot\Application\Application;
use POlbrot\HTTP\Request;

require_once __DIR__.'/vendor/autoload.php';

$app = new Application();

$req = Request::createFromGlobals();
$response = $app->handle($req);
$response->send();
