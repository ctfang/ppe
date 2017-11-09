<?php
/**
 * Created by PhpStorm.
 * User: 明月有色
 * Date: 2017/10/20
 * Time: 15:03
 */

namespace Framework\Providers;


use Phalcon\Mvc\View;

class ViewServiceProvider extends ServiceProvider
{
    protected $serviceName = 'view';

    /**
     * Register application service.
     *
     * @return mixed
     */
    public function register()
    {
        $viewDir = $this->di->getShared('bootstrap')->applicationPath . 'views/';
        // Registering a shared view component
        $this->di->set($this->serviceName, function () use ($viewDir) {
            $view = new View();

            $view->setViewsDir($viewDir);

            return $view;
        });
    }
}