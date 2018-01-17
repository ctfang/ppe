<?php
/**
 * Created by PhpStorm.
 * User: 明月有色
 * Date: 2018/1/17
 * Time: 17:37
 */

namespace Apps\Listeners;


use Apps\Events\RequestEvent;

class RequestLogListener
{
    public function handle(RequestEvent $event)
    {
        $uri = $event->dispatcher->getModuleName().'/'.$event->dispatcher->getControllerName().'/'.$event->dispatcher->getActionName();
        \Log::debug($uri,$event->dispatcher->getParams());
    }
}