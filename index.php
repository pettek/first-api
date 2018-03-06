<?php

use POlbrot\API;

require_once __DIR__.'/vendor/autoload.php';

header('Content-type: application/json');

echo((new API())->index());

