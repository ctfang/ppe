<?php
/**
 * Created by PhpStorm.
 * User: 明月有色
 * Date: 2017/7/10
 * Time: 20:09
 */

namespace Framework;

use Framework\Core\FullCore;
use Framework\Core\MicroCore;
use Framework\Providers\ServiceProviderInterface;
use Phalcon\DI\FactoryDefault;
use Phalcon\Mvc\Application;
use Symfony\Component\Debug\Debug;
use Symfony\Component\Debug\ErrorHandler;

class App
{
    /**
     * @var \Phalcon\DI
     */
    private $di;
    /**
     * @var Application
     */
    private $application;
    public  $applicationPath;

    public function __construct($applicationPath)
    {
        $this->di                = new FactoryDefault();
        $this->applicationPath = $applicationPath;

        $this->di->setShared('bootstrap', $this);
    }

    public function init()
    {
        $this->application = IS_CLI?new CliApp($this->di):new WebApp($this->di);
        $this->initDebug();
        if( !IS_CLI ){
            $this->initModule();
        }
    }

    public function initDebug()
    {
        if ($this->di->get('config')->debug) {
            Debug::enable();
        } else {
            ErrorHandler::register();
        }
    }

    public function initModule()
    {
        $modules    = $this->di->getShared('config')->modules;
        $arrModules = [];
        foreach ($modules as $moduleName => $module) {
            switch ($module['core']) {
                case 'full':
                    $arrModules[$moduleName] = [
                        "className" => FullCore::class,
                        "path"      => __DIR__ . '/core/FullCore.php',
                    ];
                    break;
                case 'micro':
                    $arrModules[$moduleName] = [
                        "className" => MicroCore::class,
                        "path"      => __DIR__ . '/core/MicroCore.php',
                    ];
                    break;
            }
        }
        $this->application->registerModules($arrModules);
    }

    public function registerAutoLoadFacades()
    {

    }

    /**
     * Initialize Services in the Dependency Injector Container.
     *
     * @param string[] $providers
     */
    public function initializeServices(array $providers)
    {
        foreach ($providers as $name => $class) {
            $this->initializeService(new $class($this->di));
        }
    }

    /**
     * Initialize the Service in the Dependency Injector Container.
     *
     * @param ServiceProviderInterface $serviceProvider
     *
     * @return $this
     */
    protected function initializeService(ServiceProviderInterface $serviceProvider)
    {
        $serviceProvider->register();
        return $this;
    }

    public function handle()
    {
        $response = $this->application->handle();

        echo $response->getContent();
    }
}