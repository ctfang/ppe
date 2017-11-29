<?php
/**
 * Created by PhpStorm.
 * User: 明月有色
 * Date: 2017/11/29
 * Time: 20:40
 */

namespace Framework\Support;

use Phalcon\Di;
use Phalcon\Mvc\View;
use Phalcon\Mvc\View\Engine\Volt;

abstract class Handler extends \Whoops\Handler\Handler
{
    /**
     * 获取路径是Common路径的视图对象
     *
     * @return View
     */
    protected function getView()
    {
        /**
         * 为了跨模块显示错误页面，这里重新设置了路径
         */
        $di              = Di::getDefault();
        $applicationPath = $di->getShared('bootstrap')->applicationPath;
        $view            = $di->getShared('view');
        $viewDir         = $applicationPath . '/apps/Modules/Common/Views/';
        $view->setViewsDir($viewDir);
        $view->registerEngines([
            ".html" => function ($view, Di $di) {
                $volt = new Volt($view, $di);

                $volt->setOptions([
                    // 编译目录
                    'compiledPath' => $di->getShared('bootstrap')->applicationPath . '/storage/cache/view',
                ]);

                return $volt;
            }
        ]);

        return $view;
    }
}