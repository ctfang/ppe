<?php
/**
 * Created by PhpStorm.
 * User: 明月有色
 * Date: 2017/10/20
 * Time: 10:57
 */

namespace Framework\Providers;


use Phalcon\Mvc\Router;

class FullRouterServiceProvider extends ServiceProvider
{
    /**
     * The Service name.
     * @var string
     */
    protected $serviceName = 'router';

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
                $router = new Router();

                $router->setDefaultModule("index");

                $router->add(
                    "/:controller/:action",
                    [
                        "module"     => "index",
                        "controller" => 1,
                        "action"     => 2,
                    ]
                );

                return $router;
            }
        );
    }
}