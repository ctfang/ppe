<?php
/**
 * Created by PhpStorm.
 * User: baichou
 * Date: 2017/12/20
 * Time: 19:52
 */

namespace Apps\Jobs;


use Framework\Support\Queue;

class DemoJob extends Queue
{
    protected $queueName = 'default';

    protected $test;

    protected function setTestValue($value)
    {
        $this->test = $value;
    }

    /**
     * 任务入口
     *
     * @return mixed
     */
    public function handle()
    {
        \Log::info('队列参数'.$this->test);
    }
}