<?php
/**
 * Created by PhpStorm.
 * User: 明月有色
 * Date: 2017/12/20
 * Time: 19:41
 */
return [
    // 是否马上运行-调试
    'run_now' => env('QUEUE_RUN_RIGHT_NOW', false),
    // 队列的reids
    'redis_backend' => env('REDIS_HOST', '127.0.0.1') . ':' . env('REDIS__PORT', '6379'),
    // 队列分组，组是启动最小单位
    'group'=>[
        'default'=>[
            'interval'=>1,
            'worker'=>4,
            'queue_name' => [
                'default'
            ],
        ],
    ],
];