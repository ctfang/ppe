<?php
/**
 * Created by PhpStorm.
 * User: 明月有色
 * Date: 2017/11/22
 * Time: 18:21
 */

namespace Apps\Modules\Index\Controllers;


use Apps\Modules\Common\Controllers\Controller;

class ToolController extends Controller
{
    public function timeToDate()
    {
        echo date('Y-m-d H:i:s',$this->request->get('time'));
    }
}