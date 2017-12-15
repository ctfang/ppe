<?php
/**
 * Created by PhpStorm.
 * User: 明月有色
 * Date: 2017/12/15
 * Time: 17:27
 */

namespace Apps\Http\Index\Controllers;


class ConfigController
{
    public function index()
    {
        dump(\Config::get('database','默认'));
    }
}