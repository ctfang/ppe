<?php
/**
 * Created by PhpStorm.
 * User: 明月有色
 * Date: 2017/10/20
 * Time: 10:39
 */

namespace Framework\Core;


use Phalcon\DiInterface;
use Phalcon\Mvc\ModuleDefinitionInterface;

class CliCore implements ModuleDefinitionInterface
{

    /**
     * Registers an autoloader related to the module
     *
     * @param DiInterface $dependencyInjector
     */
    public function registerAutoloaders(DiInterface $dependencyInjector = null)
    {

    }

    /**
     * Registers services related to the module
     *
     * @param DiInterface $dependencyInjector
     */
    public function registerServices(DiInterface $dependencyInjector)
    {

    }
}