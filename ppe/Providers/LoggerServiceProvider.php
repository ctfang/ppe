<?php
/**
 * Created by PhpStorm.
 * User: 明月有色
 * Date: 2017/11/24
 * Time: 14:56
 */

namespace Framework\Providers;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

/**
 * Class LoggerServiceProvider
 * @package Framework\Providers
 */
class LoggerServiceProvider extends ServiceProvider
{
    protected $serviceName = 'log';

    /**
     * Register application service.
     *
     * @return mixed
     */
    public function register()
    {
        $this->di->set($this->serviceName, function() {
            $logger = new Logger('test');

            $logger->pushHandler(new StreamHandler(__DIR__.'/../../storage/log/me.log',Logger::WARNING));

            return $logger;
        });
    }
}