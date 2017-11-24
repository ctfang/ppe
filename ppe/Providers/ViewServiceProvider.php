<?php
/**
 * Created by PhpStorm.
 * User: 明月有色
 * Date: 2017/10/20
 * Time: 15:03
 */

namespace Framework\Providers;


use Phalcon\Di;
use Phalcon\Mvc\View;
use Phalcon\Mvc\View\Engine\Volt;

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
        $di = $this->di;
        // Registering a shared view component
        $this->di->set($this->serviceName, function () use ($di) {
            $view    = new View();
            $viewDir = $di->getShared('module')->modulePath . '/Views';
            $view->setViewsDir($viewDir);
            $view->registerEngines([
                ".html" => function ($view, Di $di) {
                    $volt = new Volt($view, $di);

                    $volt->setOptions([
                        // 编译目录
                        'compiledPath' => function ($template) use($di) {
                            $templatePath = $di->getShared('bootstrap')->applicationPath . '/storage/cache/view';

                            $arrPath = explode('/Views/',$template);
                            unset($arrPath[0]);
                            $template = implode('',$arrPath);

                            if (!is_dir( dirname($templatePath.'/'.$template) )) {
                                mkdir(dirname($templatePath.'/'.$template),750,true);
                            }

                            return $templatePath."/{$template}.php";
                        },
                    ]);

                    return $volt;
                }
            ]);
            return $view;
        });
    }
}