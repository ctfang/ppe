<?php
/**
 * Created by PhpStorm.
 * User: 明月有色
 * Date: 2017/10/20
 * Time: 13:51
 */

namespace Framework\Providers;


use Framework\App;
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
        $this->di->setShared($this->serviceName,function (){
            $config = require App::getRootPath().'/config/app.php';
            if (is_array($config)) {
                $config = new Config($config);
            }
            return $config;
        });
    }
}