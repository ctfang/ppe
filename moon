#!/usr/bin/env php
<?php

define('IS_CLI',true);
define('CRON_STR','cron');

require __DIR__.'/bootstrap/autoload.php';

$app = require __DIR__.'/bootstrap/app.php';

$response = $app->handle();