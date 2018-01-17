<?php
/**
 * Created by PhpStorm.
 * User: 明月有色
 * Date: 2018/1/17
 * Time: 17:20
 */

namespace Apps\Events;


class DbBeforeQueryEvent
{
    /**
     * @var \Phalcon\Db\Adapter\Pdo\Mysql
     */
    public $connection;

    public function __construct($connection)
    {
        $this->connection = $connection;
    }
}