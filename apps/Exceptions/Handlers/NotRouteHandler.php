<?php
/**
 * Created by PhpStorm.
 * User: 明月有色
 * Date: 2017/11/29
 * Time: 16:00
 */

namespace Apps\Exceptions\Handlers;

use Framework\App;
use Framework\Support\Handler;
use Phalcon\Di;
use Phalcon\Mvc\Dispatcher\Exception;
use Whoops\Exception\ErrorException;

class NotRouteHandler extends Handler
{
    /**
     * 在调度器抛出任意异常前触发
     */
    public function handle()
    {
        if( $this->getException() instanceof Exception){
            /**
             * 当关闭调试模式时
             * 显示一个精简错误页面
             * 为了跨模块显示错误页面，这里使用了公共模块的视图
             */
            $view = $this->getView();

            // Start the output buffering
            $view->start();

            try{
                // Render all the view hierarchy related to the view products/list.phtml
                $view->render("Error", "404");
            }catch (ErrorException $exception){
                $cachePath = App::getRootPath() . '/storage/cache/view';
                if( !is_dir($cachePath) ){
                    mkdir($cachePath,0755,true);
                }
                $view->render("Error", "404");
            }

            // Finish the output buffering
            $view->finish();

            echo $view->getContent();

            // 如果只是访问地址错误-可以立马退出
            return Handler::QUIT;
        }
    }
}