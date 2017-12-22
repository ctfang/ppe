<?php
/**
 * Created by PhpStorm.
 * User: 明月有色
 * Date: 2017/12/11
 * Time: 14:41
 */

namespace Apps\Exceptions\Handlers;


use Framework\Support\Handler\GetEmailPrettyPageHandler;
use Whoops\Handler\Handler;

class ErrorEmailHandler extends Handler
{
    /**
     * @return int|null A handler may return nothing, or a Handler::HANDLE_* constant
     */
    public function handle()
    {
        $whoops  = $this->getRun();
        $handler = new GetEmailPrettyPageHandler();
        $handler->setRun($whoops);
        $handler->setInspector($this->getInspector());
        $handler->setException($this->getException());
        $emailBody = $handler->handle();

        // 开发发送邮件
    }
}