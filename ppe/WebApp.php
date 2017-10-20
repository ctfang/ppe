<?php
/**
 * Created by PhpStorm.
 * User: 明月有色
 * Date: 2017/10/20
 * Time: 16:00
 */

namespace Framework;

use Phalcon\Mvc\Application;

class WebApp
{
    /**
     * @var Application
     */
    private $Application;

    public function __construct($di)
    {
        $this->Application = new Application($di);
    }

    /**
     * Handles a request
     */
    public function handle()
    {
        return $this->Application->handle();
    }

    public function registerModules(array $arrModules)
    {
        return $this->Application->registerModules($arrModules);
    }

    public function getContent()
    {
        return $this->Application->getContent();
    }
}