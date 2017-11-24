<?php
/**
 * Created by PhpStorm.
 * User: 明月有色
 * Date: 2017/11/21
 * Time: 14:24
 */

namespace Apps\Modules\Common\Controllers;


class Controller extends \Phalcon\Mvc\Controller
{
    public function initialize()
    {
        $this->view->webTitle = '站点标题';
    }
}