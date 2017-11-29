<?php
/**
 * Created by PhpStorm.
 * User: 明月有色
 * Date: 2017/11/29
 * Time: 14:27
 */

namespace Apps\Exceptions;

use Apps\Exceptions\Handlers\NotRouteHandler;
use Apps\Exceptions\Handlers\ShowProdHandler;
use Framework\Support\ExceptionKernel;
use Whoops\Run;

class Kernel implements ExceptionKernel
{
    /**
     * 注册自定义错误处理
     *
     * @param Run $run
     */
    public function register(Run &$run)
    {
        $run->pushHandler(new NotRouteHandler());
        $run->pushHandler(new ShowProdHandler());
    }
}