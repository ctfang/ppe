<?php
/**
 * Created by PhpStorm.
 * User: 明月有色
 * Date: 2017/12/15
 * Time: 19:58
 */

namespace Apps\Listeners;


class DbListener
{
    protected $_profiler;

    protected $_logger;

    /**
     *创建分析器并开始纪录
     */
    public function __construct()
    {
        $this->_profiler = new Profiler();
        $this->_logger   = new Logger("../apps/logs/db.log");
    }

    /**
     * 如果事件触发器是'beforeQuery'，此函数将会被执行
     */
    public function beforeQuery($event, $connection)
    {
        $this->_profiler->startProfile($connection->getSQLStatement());
    }

    /**
     * 如果事件触发器是'afterQuery'，此函数将会被执行
     */
    public function afterQuery($event, $connection)
    {
        $this->_logger->log($connection->getSQLStatement(), Logger::INFO);
        $this->_profiler->stopProfile();
    }

    public function getProfiler()
    {
        return $this->_profiler;
    }

}