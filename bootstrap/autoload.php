<?php
/**
 * 记录框架开始时间
 */
define('FRAMEWORK_START', microtime(true));

/**
 * composer 引入
 */
require __DIR__.'/../vendor/autoload.php';

/**
 * 加载环境变量
 */
$dotenv = new Dotenv\Dotenv(__DIR__.'/../');
$dotenv->load();