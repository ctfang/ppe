<?php
/**
 * Created by PhpStorm.
 * User: 明月有色
 * Date: 2017/11/24
 * Time: 17:33
 */

namespace Apps\Exceptions;


use Phalcon\Events\Event;
use Phalcon\Mvc\Dispatcher;
use Exception;
use Phalcon\Mvc\User\Plugin;
use Phalcon\Mvc\Dispatcher\Exception as notFound;

class NotRouteExceptions extends Plugin
{
    /**
     * 404错误
     *
     * @param Event $event
     * @param Dispatcher $dispatcher
     * @param Exception $exception
     * @return bool|Exception
     */
    public function beforeException(Event $event, Dispatcher $dispatcher, Exception $exception)
    {
        if( $exception instanceof  notFound){
            $dispatcher->forward(
                [
                    'controller' => 'error',
                    'action' => 'notFound'
                ]
            );
            return false;
        }

        return $exception;
    }
}