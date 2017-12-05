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
        // 注册
        $di = $this->di;
        spl_autoload_register(function ($class) use ($di) {
            $Kernel = $di->getShared('facade');
            if ($Kernel->hasClass($class)) {
                $facade = $Kernel->getFacade($class);
                class_alias($facade, $class);
                $stringOrObject = $facade::getFacadesAccessor();
                if (is_string($stringOrObject)) {
                    $facade::setFacades(new $class());
                } else {
                    $facade::setFacades($stringOrObject);
                }
            }
        });
    }
}