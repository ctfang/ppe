<?php
/**
 * Created by PhpStorm.
 * User: 明月有色
 * Date: 2017/12/4
 * Time: 18:14
 */

namespace Framework\Providers;


use Apps\Facades\Kernel;

class LoadFacadeServiceProvider extends ServiceProvider
{
    protected $serviceName = 'facade';

    /**
     * Register application service.
     *
     * @return mixed
     */
    public function register()
    {
        $this->di->set($this->serviceName, function () {
            return new Kernel();
        });
    }
}