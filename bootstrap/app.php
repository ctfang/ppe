<?php
/**
 * Created by PhpStorm.
 * User: 明月有色
 * Date: 2017/10/8
 * Time: 上午11:14
 */

use Phalcon\Config;
use Phalcon\DI\FactoryDefault;
use Symfony\Component\Debug\Debug;

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

if( $di->get('config')->debug ){
    Debug::enable();
}
return $di;