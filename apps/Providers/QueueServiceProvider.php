<?php
/**
 * Created by PhpStorm.
 * User: baichou
 * Date: 2017/12/20
 * Time: 18:18
 */

namespace Apps\Providers;


use Apps\Services\QueueService;
use Framework\Providers\ServiceProvider;

class QueueServiceProvider extends ServiceProvider
{
    protected $serviceName = 'queue';

    /**
     * Register application service.
     *
     * @return mixed
     */
    public function register()
    {
        $this->di->setShared($this->serviceName,function (){
            return new QueueService();
        });
    }
}