<?php
/**
 * Created by PhpStorm.
 * User: 明月有色
 * Date: 2017/12/22
 * Time: 10:39
 */

namespace Apps\Exceptions\Handlers;


use Framework\Support\Exceptions\QueueException;
use Framework\Support\Handler;

/**
 * Class QueueErrorHandler
 * @package Apps\Exceptions\Handlers
 */
class QueueHandler extends Handler
{
    /**
     * 队列发送错误时触发
     *
     * @return int|null A handler may return nothing, or a Handler::HANDLE_* constant
     */
    public function handle()
    {
        $exception = $this->getException();
        if( $exception instanceof QueueException){

        }
    }
}