<?php
/**
 * Created by PhpStorm.
 * User: 明月有色
 * Date: 2017/11/24
 * Time: 17:03
 */

namespace Framework\Support\Exception;


use Whoops\Handler\Handler;

class ErrorHandlerException extends Handler
{

    /**
     * @return int|null A handler may return nothing, or a Handler::HANDLE_* constant
     */
    public function handle()
    {

    }
}