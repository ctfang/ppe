<?php
/**
 * Created by PhpStorm.
 * User: 明月有色
 * Date: 2018/1/17
 * Time: 17:11
 */

namespace Apps\Services;


use Apps\Events\DbBeforeQueryEvent;
use Apps\Events\RequestEvent;
use Apps\Listeners\DbLogListener;
use Apps\Listeners\RequestLogListener;
use Framework\Support\Event;

class EventService extends Event
{
    /**
     * 事件绑定监听器
     *
     * @var array
     */
    protected $listen = [
        DbBeforeQueryEvent::class =>[
            DbLogListener::class
        ],
        RequestEvent::class       =>[
            RequestLogListener::class,
        ],
    ];
}