<?php
/**
 * Created by PhpStorm.
 * User: 明月有色
 * Date: 2017/10/8
 * Time: 上午11:14
 */

use Framework\App;
use Phalcon\Config;
use Phalcon\DI\FactoryDefault;

/**
 * 加载环境配置
 */
if( file_exists(__DIR__.'/../.env') ){
    $env = new Dotenv\Dotenv(__DIR__.'/../');
    $env->load();
}

$di = new FactoryDefault();

/**
 * 基础配置加载
 */
$di->set('config',function () {
    $config = require __DIR__.'/../config/app.php';
    if (is_array($config)) {
        $config = new Config($config);
    }
    return $config;
});

return new App($di);