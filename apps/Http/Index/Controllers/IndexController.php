<?php
/**
 * Created by PhpStorm.
 * User: 明月有色
 * Date: 2017/10/20
 * Time: 15:06
 */

namespace Apps\Http\Index\Controllers;

use Apps\Console\Jobs\DemoJob;
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
     * 测试队列推入
     */
    public function testAddQueue()
    {
        $id = \Queue::put(new DemoJob([
            'TestValue'=>time(),
        ]));
        dump($id);
    }
}