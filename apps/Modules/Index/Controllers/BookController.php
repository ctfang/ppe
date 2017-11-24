<?php
/**
 * Created by PhpStorm.
 * User: 明月有色
 * Date: 2017/11/21
 * Time: 18:23
 */

namespace Apps\Modules\Index\Controllers;


use Apps\Modules\Common\Controllers\Controller;

class BookController extends Controller
{
    public function index()
    {
        echo file_get_contents('http://www.166xs.com/xiaoshuo/84');
    }
}