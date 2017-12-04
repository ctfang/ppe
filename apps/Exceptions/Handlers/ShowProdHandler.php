<?php
/**
 * Created by PhpStorm.
 * User: 明月有色
 * Date: 2017/11/29
 * Time: 16:33
 */

namespace Apps\Exceptions\Handlers;

use Framework\Support\Handler;
use Phalcon\Di;
use Whoops\Exception\ErrorException;

/**
 * @package Apps\Exceptions\Handlers
 */
class ShowProdHandler extends Handler
{
    /**
     * @return int|null A handler may return nothing, or a Handler::HANDLE_* constant
     */
    public function handle()
    {
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
            $view->render("Error", "500");
        }catch (ErrorException $exception){
            $cachePath = Di::getDefault()->getShared('bootstrap')->applicationPath . '/storage/cache/view';
            if( !is_dir($cachePath) ){
                mkdir($cachePath,0755,true);
            }
            $view->render("Error", "500");
        }

        // Finish the output buffering
        $view->finish();

        echo $view->getContent();
    }
}