<?php
/**
 * Created by PhpStorm.
 * User: 明月有色
 * Date: 2017/11/29
 * Time: 14:27
 */

namespace Apps\Exceptions;

use Apps\Exceptions\Handlers\ErrorEmailHandler;
use Apps\Exceptions\Handlers\NotRouteHandler;
use Apps\Exceptions\Handlers\QueueHandler;
use Apps\Exceptions\Handlers\ShowProdHandler;
use Framework\Support\ExceptionKernel;
use Whoops\Run;

class Kernel implements ExceptionKernel
{
    /**
     * 注册自定义错误处理-CLI模块
     *
     * @param Run $run
     */
    public function registerForCli(Run &$run)
    {
        $run->pushHandler(new ErrorEmailHandler());
        $run->pushHandler(new QueueHandler());
    }

    /**
     * 注册自定义错误处理-页面模块
     *
     * @param Run $run
     */
    public function registerForWeb(Run &$run)
    {
        $run->pushHandler(new ErrorEmailHandler());
        // 500页面显示
        $run->pushHandler(new ShowProdHandler());
        // 404页面显示
        $run->pushHandler(new NotRouteHandler());
    }
}