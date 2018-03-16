<?php

use Doctrine\ORM\Tools\Console\ConsoleRunner;
use POlbrot\Application\Application;

require_once __DIR__ . '/vendor/autoload.php';


$app = new Application();

$em = $app->getEntityManager();

return ConsoleRunner::createHelperSet($em);