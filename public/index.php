<?php


require __DIR__.'/../bootstrap/autoload.php';

$app = require __DIR__.'/../bootstrap/app.php';

$response = $app->handle();
