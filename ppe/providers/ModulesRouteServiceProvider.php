<?php
/**
 * Created by PhpStorm.
 * User: 明月有色
 * Date: 2017/10/20
 * Time: 14:07
 */

namespace Framework\Providers;


use Phalcon\Config;
use Phalcon\Mvc\Router;

class ModulesRouteServiceProvider extends ServiceProvider
{

    /**
     * Register application service.
     *
     * @return mixed
     */
    public function register()
    {
        if (IS_CLI) {
            $this->registerConsole();
        } else {
            $this->registerWeb();
        }
    }

    private function registerConsole()
    {
        $applicationPath = $this->di->getShared('bootstrap')->applicationPath;

        define('IS_CRON',(isset($GLOBALS['argv'][1]) && $GLOBALS['argv'][1]==CRON_STR)?true:false);

        if( IS_CRON ){
            $this->di->set('module',function ()use ($applicationPath){
                return new Config([
                    'modulePath'=>$applicationPath.'/console',
                    'defaultNamespace'=>"\\Apps\\Console\\Cron",
                ]);
            });
        }else{
            $this->di->set('module',function ()use ($applicationPath){
                return new Config([
                    'modulePath'=>$applicationPath.'/console',
                    'defaultNamespace'=>"\\Apps\\Console\\Tasks",
                ]);
            });
        }

        $this->di->set( "router",function (){
            $router = new \Phalcon\Cli\Router();
            $router->setDefaultModule('cli');
            return $router;
        });
    }

    private function registerWeb()
    {
        $router     = new Router();
        $config     = $this->di->getShared('config');
        $modules    = $config->modules;
        $router->setDefaultModule($config->default_module);
        foreach ($modules as $moduleName => $module) {
            $module['domain'] = $module['domain'] ?? $moduleName;

            $router->add(
                "{$module['domain']}",
                [
                    "module"     => $moduleName,
                    "controller" => 'index',
                    "action"     => 'index',
                ]
            );

            $router->add(
                "{$module['domain']}/",
                [
                    "module"     => $moduleName,
                    "controller" => 'index',
                    "action"     => 'index',
                ]
            );

            $router->add(
                "{$module['domain']}/:controller",
                [
                    "module"     => $moduleName,
                    "controller" => 1,
                    "action"     => 'index',
                ]
            );

            $router->add(
                "{$module['domain']}/:controller/:action",
                [
                    "module"     => $moduleName,
                    "controller" => 1,
                    "action"     => 2,
                ]
            );

            $router->add(
                "{$module['domain']}/:controller/:action/:params",
                [
                    "module"     => $moduleName,
                    "controller" => 1,
                    "action"     => 2,
                    "params"     => 3
                ]
            );
        }
        $router->handle($_SERVER['HTTP_HOST'].$_SERVER['REDIRECT_URL']);

        $applicationPath = $this->di->getShared('bootstrap')->applicationPath;
        $moduleName      = $router->getModuleName();
        $nameSpace       = $modules[$moduleName]['nameSpace'];

        $module = new Config([
            'modulePath'=>$applicationPath.'/modules/'.$moduleName,
            'defaultNamespace'=>"\\Apps\\Modules\\{$nameSpace}\\Controllers",
        ]);

        $this->di->set('module',function ()use ($module){
            return $module;
        });

        $this->di->set( "router",function ()use ($router){
            return $router;
        });
    }
}