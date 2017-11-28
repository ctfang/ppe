<?php
/**
 * Created by PhpStorm.
 * User: 明月有色
 * Date: 2017/11/28
 * Time: 13:51
 */

namespace Apps\Providers;

use Framework\Providers\ServiceProvider;
use Monolog\Logger;

class EmailLoggerServiceProvider extends ServiceProvider
{
    /**
     * @return Logger
     */
    public function getLogger()
    {
        return $this->di->getShared('logger');
    }
    /**
     * 如果需要对日记发送邮件
     */
    public function register()
    {
//        $logger = $this->getLogger();
//        $logger->pushHandler(new EmailHandler());
    }
}