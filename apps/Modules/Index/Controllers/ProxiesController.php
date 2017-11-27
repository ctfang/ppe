<?php
/**
 * Created by PhpStorm.
 * User: 明月有色
 * Date: 2017/11/22
 * Time: 17:28
 */

namespace Apps\Modules\Index\Controllers;


use Apps\Modules\Common\Controllers\Controller;
use Unirest\Request;

class ProxiesController extends Controller
{
    /**
     * 代理get请求
     */
    public function get()
    {
        $url        = $this->request->get('url');
        $headers    = $this->request->get('headers');
        $headers    = $headers??[];
        $parameters = $this->request->get('parameters');
        $parameters = $parameters??[];
        $data       = Request::get($url, $headers, $parameters);
        echo $data->raw_body;
    }

    /**
     * 代理post请求
     */
    public function post()
    {
        $url     = $this->request->get('url');
        $headers = $this->request->get('headers');
        $headers = $headers??[];
        $body    = $this->request->get('body');
        $body    = $body??[];
        $data    = Request::post($url, $headers, $body);
        echo $data->raw_body;
    }
}