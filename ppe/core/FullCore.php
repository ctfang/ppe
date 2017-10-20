<?php
/**
 * Created by PhpStorm.
 * User: 明月有色
 * Date: 2017/10/20
 * Time: 10:32
 */

namespace Framework\Core;


use Phalcon\DiInterface;
use Phalcon\Mvc\ModuleDefinitionInterface;

class FullCore implements ModuleDefinitionInterface
{

    /**
     * Registers an autoloader related to the module
     *
     * @param DiInterface $dependencyInjector
     */
    public function registerAutoloaders(DiInterface $dependencyInjector = null)
    {
        echo "OK";exit(0);
    }

    /**
     * Registers services related to the module
     *
     * @param DiInterface $dependencyInjector
     */
    public function registerServices(DiInterface $dependencyInjector)
    {
        echo "OK";exit(0);
    }
}