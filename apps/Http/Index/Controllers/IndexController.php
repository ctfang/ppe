<?php
/**
 * Created by PhpStorm.
 * User: 明月有色
 * Date: 2017/10/20
 * Time: 15:06
 */

namespace Apps\Http\Index\Controllers;

use Apps\Http\Common\Controllers\Controller;

class IndexController extends Controller
{
    public function index()
    {
        throw new \Exception('测试错误');
        $this->view->pick('home');
    }

    /**
     * 自动更新代码
     */
    public function getPull()
    {
        system("git pull");
    }

    /**
     * warning日记记录
     */
    public function waring()
    {
        file_get_contents('/fdasf/fdsafdsa');
    }
}