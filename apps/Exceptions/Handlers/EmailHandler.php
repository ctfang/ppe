<?php
/**
 * Created by PhpStorm.
 * User: 明月有色
 * Date: 2017/12/11
 * Time: 14:41
 */

namespace Apps\Exceptions\Handlers;


use Whoops\Handler\Handler;
use Whoops\Handler\PrettyPageHandler;

class EmailHandler extends Handler
{
    /**
     * @return int|null A handler may return nothing, or a Handler::HANDLE_* constant
     */
    public function handle()
    {
        $whoops = $this->getRun();

        $whoops->pushHandler(new PrettyPageHandler());

        $body = $whoops->handleException($this->getException());

        die($body);
    }
}