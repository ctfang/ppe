<?php

// 当不能处理异常时，可以强制洗显示所有错误
// error_reporting(E_ALL);
// ini_set('display_errors', 1);

require __DIR__.'/../bootstrap/autoload.php';

$app = require __DIR__.'/../bootstrap/app.php';

$response = $app->handle();
