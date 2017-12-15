<?php
/**
 * Created by PhpStorm.
 * User: 明月有色
 * Date: 2017/12/15
 * Time: 16:57
 */

namespace Framework\Providers;


use Phalcon\Db\Adapter\Pdo\Mysql;
use Phalcon\Mvc\Model\Manager;

class DatabaseServiceProvider extends ServiceProvider
{
    protected $serviceName = 'db';

    /**
     * Register application service.
     *
     * @return mixed
     */
    public function register()
    {
        $this->di->setShared($this->serviceName, function () {
            $eventsManager = new Manager();
            $dataBaseCfg = $this->getShared('config')->database->toArray();
            $connection  = new Mysql($dataBaseCfg['database']);
            unset($dataBaseCfg);
            $eventsManager->attach('db', new DatabaseEvent());
            $connection->setEventsManager($eventsManager);
            return $connection;
        });
    }
}