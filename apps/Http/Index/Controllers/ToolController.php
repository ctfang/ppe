<?php
/**
 * Created by PhpStorm.
 * User: 明月有色
 * Date: 2017/11/22
 * Time: 18:21
 */

namespace Apps\Http\Index\Controllers;


use Apps\Http\Common\Controllers\Controller;

class ToolController extends Controller
{
    public function timeToDate()
    {
        echo date('Y-m-d H:i:s',$this->request->get('time'));
    }
}