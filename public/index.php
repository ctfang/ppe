<?php


require __DIR__.'/../bootstrap/autoload.php';

$di = require __DIR__.'/../bootstrap/app.php';

$app = (new \Framework\Application($di));

$response = $app->handle();
