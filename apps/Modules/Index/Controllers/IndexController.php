<?php
/**
 * Created by PhpStorm.
 * User: 明月有色
 * Date: 2017/10/20
 * Time: 15:06
 */

namespace Apps\Modules\Index\Controllers;

use Apps\Modules\Common\Controllers\Controller;

class IndexController extends Controller
{
    public function index()
    {
        throw new \Exception('发送报错');
        $this->view->pick('home');
    }

    /**
     * 自动更新代码
     */
    public function getPull()
    {
        system("git pull");
    }
}