<?php
/**
 * Created by PhpStorm.
 * User: baichou
 * Date: 2017/12/20
 * Time: 19:52
 */

namespace Apps\Console\Jobs;


use Framework\Support\Queue;

class DemoJob extends Queue
{
    protected $queueName = 'default';

    protected $test;
    protected $optional;

    /**
     * 必须传入的值
     *
     * @param $value
     */
    protected function setParamTestValue($value)
    {
        $this->test = $value;
    }

    /**
     * 可选参数
     *
     * @param string $optional
     */
    protected function setParamTestOptional($optional='默认值')
    {
        $this->optional = $optional;
    }

    /**
     * 任务入口
     *
     * @return mixed
     */
    public function handle()
    {
        \Log::info('队列参数'.$this->test);
        dump($ffff);
    }
}