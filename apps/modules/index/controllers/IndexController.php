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
        $this->view->pick('home');
    }
}