<?php
/**
 * Created by PhpStorm.
 * User: 明月有色
 * Date: 2017/7/10
 * Time: 20:09
 */

namespace Framework;

use Symfony\Component\Debug\Debug;
use Symfony\Component\Debug\ErrorHandler;

class App
{
    /**
     * @var \Phalcon\DI
     */
    private $di;

    public function __construct($di)
    {
        $this->di = $di;
        $this->initDebug();
    }

    public function initDebug()
    {
        if( $this->di->get('config')->debug ){
            Debug::enable();
        }else{
            ErrorHandler::register();
        }
    }

    public function registerAutoLoadFacades()
    {

    }

    public function handle()
    {
        var_dump($this->di->getShared('config'),__DIR__);
    }
}