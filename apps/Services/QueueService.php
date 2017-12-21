<?php
/**
 * Created by PhpStorm.
 * User: 明月有色
 * Date: 2017/12/20
 * Time: 18:27
 */

namespace Apps\Services;

use Framework\Support\Queue;
use Resque;

class QueueService
{
    public function __construct()
    {
        $config = \Config::get('queue')->toArray();
        Resque::setBackend($config['redis_backend']);
    }

    public function put($obj=false)
    {
        if( $obj instanceof Queue){
            return Resque::enqueue($obj->getQueueName(),get_class($obj),$obj->getParams(),false);
        }else{
            throw new \Exception('JOB必须继承与'.Queue::class);
        }
    }
}