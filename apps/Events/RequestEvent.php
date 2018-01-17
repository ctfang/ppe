<?php
/**
 * Created by PhpStorm.
 * User: 明月有色
 * Date: 2018/1/17
 * Time: 16:43
 */

namespace Apps\Events;


use Phalcon\Mvc\Dispatcher;

class RequestEvent
{
    /**
     * @var Dispatcher
     */
    public $dispatcher;

    public function __construct($dispatcher)
    {
        $this->dispatcher = $dispatcher;
    }
}