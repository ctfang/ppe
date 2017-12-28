<?php
/**
 * Created by PhpStorm.
 * User: 明月有色
 * Date: 2017/12/25
 * Time: 17:19
 */

namespace Apps\Providers;

use Framework\Providers\ServiceProvider;
use Phalcon\Http\Cookie;
use Phalcon\Session\Adapter\Files;

class SessionServiceProvider extends ServiceProvider
{
    protected $serviceName = 'session';

    /**
     * Register application service.
     *
     * @return mixed
     */
    public function register()
    {
        $this->di->setShared($this->serviceName,function (){
            $session = new Files();
            $session->start();
            return $session;
        });
    }
}