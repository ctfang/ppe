<?php
/**
 * Created by PhpStorm.
 * User: 明月有色
 * Date: 2017/11/21
 * Time: 18:23
 */

namespace Apps\Http\Index\Controllers;


use Apps\Http\Common\Controllers\Controller;
use Unirest\Request;

class BookController extends Controller
{
    public function index()
    {
        $url               = 'http://phalcon.ctfang.com/proxies/get';
        $parameters['url'] = 'http://www.dingdian.me/105194/';
        $headers           = [];
        $data              = Request::get($url, $headers, $parameters);
        echo $data->raw_body;
    }
}