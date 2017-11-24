<?php
/**
 * Created by PhpStorm.
 * User: 明月有色
 * Date: 2017/10/20
 * Time: 13:51
 */

namespace Framework\Providers;


use Phalcon\Config;

class ConfigServiceProvider extends ServiceProvider
{
    protected $serviceName = 'config';

    /**
     * Register application service.
     *
     * @return mixed
     */
    public function register()
    {
        $applicationPath = $this->di->getShared('bootstrap')->applicationPath;

        $this->di->setShared($this->serviceName,function () use ($applicationPath) {
            $config = require $applicationPath.'/config/app.php';
            if (is_array($config)) {
                $config = new Config($config);
            }
            return $config;
        });
    }
}