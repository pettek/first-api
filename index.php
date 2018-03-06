<?php

use POlbrot\API;

require_once __DIR__.'/vendor/autoload.php';

$api = new API();

if ($_SERVER['REQUEST_URI'] === '/api') {
    header('Content-type: application/json');

    echo $api->index();
}
