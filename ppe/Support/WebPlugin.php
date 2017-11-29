<?php
/**
 * Created by PhpStorm.
 * User: 明月有色
 * Date: 2017/11/29
 * Time: 16:01
 */

namespace Framework\Support;

use Exception;
use Phalcon\Di;
use Whoops\Run;
use Phalcon\Events\Event;
use Phalcon\Mvc\Dispatcher;

abstract class WebPlugin
{
    /**
     * @var Dispatcher
     */
    public $dispatcher;
    /**
     * @var Exception
     */
    public $exception;

    public $event;


    /**
     * 在调度器抛出任意异常前触发
     *
     * @return bool|Exception
     */
    abstract public function handle();


    public final function __construct(Event $event,Dispatcher $dispatcher, Exception $exception)
    {
        $this->dispatcher = $dispatcher;
        $this->exception  = $exception;
        $this->event       = $event;
    }

    public function getEvent()
    {
        return $this->event;
    }

    public function getDispatcher()
    {
        return $this->dispatcher;
    }

    public function getException()
    {
        return $this->exception;
    }

    /**
     * @return Run
     */
    public function getRun()
    {
        return Di::getDefault()->getShared('exception');
    }
}