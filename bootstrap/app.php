<?php
/**
 * Created by PhpStorm.
 * User: 明月有色
 * Date: 2017/10/8
 * Time: 上午11:14
 */

use Framework\App;

defined('IS_CLI') or define('IS_CLI',false);

$app = new App(dirname(__DIR__));

$app->initializeServices([
    \Framework\Providers\ConfigServiceProvider::class,
    \Framework\Providers\ModulesRouteServiceProvider::class,
    \Framework\Providers\MvcDispatcherServiceProvider::class,
    \Framework\Providers\LoggerServiceProvider::class,
    \Framework\Providers\ExceptionHandlerServiceProvider::class,
    \Framework\Providers\LoadFacadeServiceProvider::class,
    \Framework\Providers\EventServiceProvider::class,

    // 引入数据库
    \Framework\Providers\DatabaseServiceProvider::class,
    // 引入队列
    \Apps\Providers\QueueServiceProvider::class,
]);

$app->init();

return $app;