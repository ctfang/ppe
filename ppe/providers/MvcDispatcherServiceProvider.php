<?php
/**
 * Created by PhpStorm.
 * User: 明月有色
 * Date: 2017/10/20
 * Time: 10:49
 */

namespace Framework\Providers;


use Phalcon\Cli\Dispatcher;
use Phalcon\Di;
use Phalcon\Mvc\Dispatcher as DispatcherMvc;

class MvcDispatcherServiceProvider extends ServiceProvider
{
    /**
     * The Service name.
     * @var string
     */
    protected $serviceName = 'dispatcher';

    /**
     * Register application service.
     *
     * @return void
     */
    public function register()
    {
        $this->di->setShared(
            $this->serviceName,
            function () {
                if( IS_CLI ){
                    $dispatcher = new Dispatcher();
                }else{
                    $dispatcher = new DispatcherMvc();
                }
                $module     = Di::getDefault()->getShared('module');
                $dispatcher->setDefaultNamespace($module['defaultNamespace']);
                $dispatcher->setActionSuffix('');
                return $dispatcher;
            }
        );
    }
}