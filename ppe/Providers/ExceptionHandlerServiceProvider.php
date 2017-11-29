<?php
/**
 * Created by PhpStorm.
 * User: 明月有色
 * Date: 2017/11/29
 * Time: 18:08
 */

namespace Framework\Providers;


use Apps\Exceptions\Kernel;
use Framework\Support\Exception\LoggerHandlerException;
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
            }
            // 日记处理
            $whoops->pushHandler(new LoggerHandlerException());

            (new Kernel())->register($whoops);

            return $whoops;
        });

        $whoops = $this->di->getShared('exception');
        $whoops->register();
    }
}