<?php
/**
 * Created by PhpStorm.
 * User: 明月有色
 * Date: 2017/11/21
 * Time: 18:23
 */

namespace Apps\Modules\Index\Controllers;


use Apps\Modules\Common\Controllers\Controller;
use Unirest\Request;

class BookController extends Controller
{
    public function index()
    {
        $url               = 'http://phalcon.ctfang.com/proxies/get';
        $parameters['url'] = 'http://www.166xs.com/xiaoshuo/84';
        $headers           = [];
        $parameters        = [];
        $data              = Request::get($url, $headers, $parameters);
        echo $data->raw_body;
    }
}