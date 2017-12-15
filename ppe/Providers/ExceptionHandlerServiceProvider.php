<?php
/**
 * Created by PhpStorm.
 * User: 明月有色
 * Date: 2017/11/29
 * Time: 18:08
 */

namespace Framework\Providers;


use Apps\Exceptions\Kernel;
use Framework\Support\Exceptions\LoggerHandlerException;
use Whoops\Handler\JsonResponseHandler;
use Whoops\Handler\PlainTextHandler;
use Whoops\Handler\PrettyPageHandler;
use Whoops\Run;
use Whoops\Util\Misc;

class ExceptionHandlerServiceProvider extends ServiceProvider
{
    protected $serviceName = 'exception';

    /**
     * Register application service.
     *
     * @return mixed
     */
    public function register()
    {
        $isDebug = $this->di->get('config')->debug;
        $this->di->setShared($this->serviceName,function () use ($isDebug) {
            $whoops = new Run;
            if ( $isDebug ) {
                // 开始调试
                if( Misc::isCommandLine() ){
                    $PlainTextHandler = new PlainTextHandler();
                    $whoops->pushHandler($PlainTextHandler);
                }elseif (Misc::isAjaxRequest()){
                    $whoops->pushHandler(new JsonResponseHandler());
                }else{
                    $PrettyPageHandler = new PrettyPageHandler;
                    $PrettyPageHandler->setPageTitle('发生错误');
                    $whoops->pushHandler( $PrettyPageHandler );
                }
            }else{
                // 非调试-不报告 E_NOTICE && E_WARNING
                error_reporting(E_ALL^E_NOTICE^E_WARNING);
            }
            if( Misc::isCommandLine() ){
                (new Kernel())->registerForCli($whoops);
            }else{
                (new Kernel())->registerForWeb($whoops);
            }
            // 日记处理
            $whoops->pushHandler(new LoggerHandlerException());

            return $whoops;
        });
    }
}