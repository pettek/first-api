<?php

require_once __DIR__.'/vendor/autoload.php';

header('Content-type: application/json');

$variable = \POlbrot\API::index();

echo($variable);