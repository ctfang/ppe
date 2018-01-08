<?php
/**
 * Created by PhpStorm.
 * User: 明月有色
 * Date: 2017/11/29
 * Time: 14:27
 */

namespace Apps\Exceptions;

use Apps\Exceptions\Handlers\NotRouteHandler;
use Apps\Exceptions\Handlers\QueueHandler;
use Apps\Exceptions\Handlers\ShowProdHandler;
use Framework\Support\ExceptionKernel;
use Framework\Support\Handler\InitModuleHandler;
use Phalcon\Di;
use Whoops\Handler\JsonResponseHandler;
use Whoops\Handler\PlainTextHandler;
use Whoops\Handler\PrettyPageHandler;
use Whoops\Run;
use Whoops\Util\Misc;

/**
 * 异常椎，处理顺序：先入后出
 *
 * 非调试-不报告
 *      E_NOTICE && E_WARNING
 *      error_reporting(E_ALL^E_NOTICE^E_WARNING);
 *
 * @package Apps\Exceptions
 */
class Kernel implements ExceptionKernel
{
    /**
     * 注册自定义错误处理-CLI模块
     *
     * @param Run $run
     */
    public function registerForCli(Run &$run)
    {
        $run->pushHandler(new QueueHandler());
        $run->pushHandler(new PlainTextHandler());
    }

    /**
     * 注册自定义错误处理-页面模块
     *
     * @param Run $run
     */
    public function registerForWeb(Run &$run)
    {
        // 500页面显示
        $run->pushHandler(new ShowProdHandler());

        // 调试下，可以显示更加具体的错误
        if ( Di::getDefault()->get('config')->debug ) {
            // 开始调试
            if (Misc::isAjaxRequest()) {
                $run->pushHandler(new JsonResponseHandler());
            } else {
                $run->pushHandler(new PrettyPageHandler());
                // 检查模块是否初始化
                $run->pushHandler(new InitModuleHandler());
            }
        }

        // 404页面显示，404不需要特殊处理，可以放到后面推入，最先处理
        $run->pushHandler(new NotRouteHandler());
    }
}