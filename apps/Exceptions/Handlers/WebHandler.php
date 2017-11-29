<?php
/**
 * Created by PhpStorm.
 * User: 明月有色
 * Date: 2017/11/29
 * Time: 16:00
 */

namespace Apps\Exceptions\Handlers;


use Exception;
use Framework\Support\WebPlugin;
use Phalcon\Di;
use Phalcon\Dispatcher;

class WebHandler extends WebPlugin
{
    /**
     * 在调度器抛出任意异常前触发
     * 只处理404错误
     *
     * @return bool|Exception
     */
    public function handle()
    {
        $exception  = $this->getException();

        // 代替控制器或者动作不存在时的路径
        if ($this->getEvent()->getType() == 'beforeException') {
            switch ($exception->getCode()) {
                case Dispatcher::EXCEPTION_HANDLER_NOT_FOUND:
                case Dispatcher::EXCEPTION_ACTION_NOT_FOUND:
                    $this->getDispatcher()->forward(array(
                        'controller' => 'error',
                        'action' => 'notFound'
                    ));
                    return false;
            }
        }
        if( !Di::getDefault()->get('config')->debug ){
            // 不开启调试时候-显示错误页面
            $this->getDispatcher()->forward(array(
                'controller' => 'error',
                'action' => 'notFound'
            ));
            /**
             * 推送进入主handler
             */
            $this->getRun()->handleException($exception);
            return false;
        }
    }
}