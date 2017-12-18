<?php
/**
 * Created by PhpStorm.
 * User: 明月有色
 * Date: 2017/7/10
 * Time: 20:09
 */

namespace Framework;

use Dotenv\Dotenv;
use Framework\Core\CliCore;
use Framework\Core\FullCore;
use Framework\Core\MicroCore;
use Framework\Providers\ServiceProviderInterface;
use Phalcon\DI\FactoryDefault;
use Phalcon\Mvc\Application;


class App
{
    private static $path;
    /**
     * @var \Phalcon\DI
     */
    private $di;
    /**
     * @var Application
     */
    private $application;

    /**
     * App constructor.
     * @param $applicationPath
     */
    public function __construct($applicationPath)
    {
        self::$path = $applicationPath;
        
        if (file_exists($applicationPath . '/.env')) {
            $env = new Dotenv($applicationPath . '/');
            $env->load();
        }
        $this->di   = new FactoryDefault();
    }

    /**
     * 获取项目根目录
     *
     * @return mixed
     */
    public static function getRootPath()
    {
        return self::$path;
    }

    /**
     * 在基础DI注册完后调用
     */
    public function init()
    {
        // 时区设置
        date_default_timezone_set( $this->di->getShared('config')->timezone );
        // 异常注册
        $this->registerException();
        // 门脸注册
        $this->registerAutoLoadFacades();
        if (!IS_CLI) {
            $this->application = new WebApp($this->di);
            $this->initModule();
        } else {
            $this->application = new CliApp($this->di);
            $this->application->registerModules([
                'cli' => [
                    "className" => CliCore::class,
                    "path"      => __DIR__ . '/Core/CliCore.php',
                ],
            ]);
        }
    }

    /**
     * 注册异常处理
     */
    protected function registerException()
    {
        $whoops = $this->di->getShared('exception');
        $whoops->register();
    }

    /**
     * 初始化模块
     */
    public function initModule()
    {
        $modules    = $this->di->getShared('config')->modules;
        $arrModules = [];
        foreach ($modules as $moduleName => $module) {
            switch ($module['core']) {
                case 'full':
                    $arrModules[$moduleName] = [
                        "className" => FullCore::class,
                        "path"      => __DIR__ . '/Core/FullCore.php',
                    ];
                    break;
                case 'micro':
                    $arrModules[$moduleName] = [
                        "className" => MicroCore::class,
                        "path"      => __DIR__ . '/Core/MicroCore.php',
                    ];
                    break;
            }
        }
        $this->application->registerModules($arrModules);
    }

    /**
     * 门脸启用
     */
    public function registerAutoLoadFacades()
    {
        if ($this->di->has('facade')) {
            $di = $this->di;
            spl_autoload_register(function ($class) use ($di) {
                $Kernel = $di->getShared('facade');
                if ($Kernel->hasClass($class)) {
                    $facade = $Kernel->getFacade($class);
                    class_alias($facade, $class);
                    $stringOrObject = $facade::getFacadesAccessor();
                    if (is_string($stringOrObject)) {
                        $facade::setFacades(new $class());
                    } else {
                        $facade::setFacades($stringOrObject);
                    }
                }
            });
        }
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