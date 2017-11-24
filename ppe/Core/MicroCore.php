<?php
/**
 * Created by PhpStorm.
 * User: 明月有色
 * Date: 2017/10/20
 * Time: 10:38
 */

namespace Framework\Core;


use Phalcon\DiInterface;
use Phalcon\Mvc\ModuleDefinitionInterface;
use Whoops\Handler\PrettyPageHandler;
use Whoops\Run;

class MicroCore implements ModuleDefinitionInterface
{

    /**
     * Registers an autoloader related to the module
     *
     * @param DiInterface $dependencyInjector
     */
    public function registerAutoloaders(DiInterface $dependencyInjector = null)
    {
        $whoops = new Run;
        $whoops->pushHandler(new PrettyPageHandler);
        $whoops->register();
    }

    /**
     * Registers services related to the module
     *
     * @param DiInterface $dependencyInjector
     */
    public function registerServices(DiInterface $dependencyInjector)
    {
        // TODO: Implement registerServices() method.
    }
}